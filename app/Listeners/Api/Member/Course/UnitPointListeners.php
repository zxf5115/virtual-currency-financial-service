<?php
namespace App\Listeners\Api\Member\Course;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\Course\UnitPointEvent;
use App\Models\Api\Module\Education\Course\Course;
use App\Models\Api\Module\Member\Relevance\Course as MemberCourse;
use App\Models\Api\Module\Member\Relevance\Relevance\Unit as MemberUnit;
use App\Models\Api\Module\Member\Relevance\Relevance\Relevance\Point as MemberPoint;
use App\Models\Api\Module\Education\Courseware\Relevance\Relevance\Unit;
use App\Models\Api\Module\Education\Courseware\Relevance\Relevance\Relevance\Point;

/**
 * 添加课程单元知识点监听器
 */
class UnitPointListeners
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
   * @param  UnitPointEvent  $event
   * @return void
   */
  public function handle(UnitPointEvent $event)
  {
    try
    {
      $course_id     = $event->course_id;
      $courseware_id = $event->courseware_id;
      $level_id      = $event->level_id;
      $member_id     = $event->member_id;


      $where = [
        'id'     => $course_id,
        'status' => 1
      ];

      $course = Course::getRow($where, ['unlock']);

      if(empty($course) || empty($course->unlock))
      {
        \Log::error('暂无课程');

        return false;
      }

      $memberCourseModel = MemberCourse::firstOrNew([
        'member_id'        => $member_id,
        'course_id'        => $course_id,
        'courseware_id'    => $courseware_id,
        'level_id'         => $level_id
      ]);

      $memberCourseModel->apply_time   = time();
      $memberCourseModel->apply_status = 0;
      $memberCourseModel->save();

      $k = 0; //
      $flag = 0;
      $course_start_time = strtotime($course->course_start_time);
      $section           = $course->unlock->section;
      $duration          = $course->unlock->duration;

      $where = [
        'courseware_id' => $courseware_id,
        'level_id'      => $level_id,
        'status'        => 1
      ];

      $orders = [['key' => 'sort', 'value' => 'desc']];
      $unit = Unit::getList($where, false, $orders);

      foreach($unit as $item)
      {
        if($flag >= $section)
        {
          $k++;
        }

        $wait_unlock_time = $course_start_time + ($k * $duration * 86400);

        // 保存
        $memberUnitModel = MemberUnit::firstOrNew([
          'member_id'        => $member_id,
          'course_id'        => $course_id,
          'courseware_id'    => $courseware_id,
          'level_id'         => $level_id,
          'unit_id'          => $item->id,
          'wait_unlock_time' => $wait_unlock_time,
        ]);

        $memberUnitModel->save();

        $where['unit_id'] = $item->id;

        $point = Point::getList($where);

        foreach($point as $vo)
        {
          // 保存
          $memberPoinModel = MemberPoint::firstOrNew([
            'member_id'     => $member_id,
            'course_id'     => $course_id,
            'courseware_id' => $courseware_id,
            'level_id'      => $level_id,
            'unit_id'       => $item->id,
            'point_id'      => $vo->id
          ]);

          $memberPoinModel->save();
        }

        if($flag >= $section)
        {
          $flag = 0;
        }
        else
        {
          $flag++;
        }
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
