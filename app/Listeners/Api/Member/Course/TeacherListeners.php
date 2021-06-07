<?php
namespace App\Listeners\Api\Member\Course;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\Course\TeacherEvent;
use App\Models\Api\Module\Education\Course\Course;
use App\Models\Api\Module\Education\Course\Relevance\Teacher;
use App\Models\Api\Module\Member\Relevance\Course as MemberCourse;

/**
 * 添加管理老师监听器
 */
class TeacherListeners
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  /**
   * Handle the event.
   *
   * @param  TeacherEvent  $event
   * @return void
   */
  public function handle(TeacherEvent $event)
  {
    try
    {
      $course_id     = $event->course_id;
      $courseware_id = $event->courseware_id;
      $level_id      = $event->level_id;
      $member_id     = $event->member_id;

      // 获取每位老师管理人数
      $course = Course::getRow(['id' => $course_id]);

      $class_size    = $course->class_size;

      $where = [
        'course_id'     => $course_id,
        'courseware_id' => $courseware_id,
        'level_id'      => $level_id,
      ];

      $teacherWhere = ['status' => 1];

      $teacherWhere = array_merge($where, $teacherWhere);

      // 获取当前课程包含几位老师
      $teacher = Teacher::getList($teacherWhere);

      // 如果为空抛出异常
      if(empty($teacher))
      {
         return false;
      }

      // 此课程的管理老师列表
      foreach($teacher as $item)
      {
        $teacherWhere = ['teacher_id' => $item->teacher_id];

        $teacherWhere = array_merge($where, $teacherWhere);

        $total = MemberCourse::getCount($teacherWhere);

        // 如果老师的学生数大于课程规定管理人数，跳到下一个老师
        if($total >= $class_size)
        {
          continue;
        }

        $memberWhere = ['member_id' => $member_id];

        $memberWhere = array_merge($where, $memberWhere);

        // 降新购买课程的学员添加管理老师
        $model = MemberCourse::getRow($memberWhere);

        $model->teacher_id = $item->teacher_id;
        $model->save();
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
