<?php
namespace App\Listeners\Api\Member\Course;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\Course\UnitFinishEvent;
use App\Models\Api\Module\Member\Relevance\Course;
use App\Models\Api\Module\Member\Relevance\Relevance\Unit;
use App\Models\Api\Module\Member\Relevance\Relevance\Relevance\Point;

/**
 * 完成课程单元学习监听器
 */
class UnitFinishListeners
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
   * @param  UnitFinishEvent  $event
   * @return void
   */
  public function handle(UnitFinishEvent $event)
  {
    try
    {
      $member_id     = $event->member_id;
      $course_id     = $event->course_id;
      $courseware_id = $event->courseware_id;
      $level_id      = $event->level_id;
      $unit_id       = $event->unit_id;

      $where = [
        'member_id'     => $member_id,
        'course_id'     => $course_id,
        'courseware_id' => $courseware_id,
        'level_id'      => $level_id,
        'unit_id'       => $unit_id,
        'status'        => 1
      ];

      // 获取每位老师管理人数
      $point = Point::getPluck('is_finish', $where, false, false, true);

      $result = array_column($point, 'value');

      // 如果课程单元知识点全部学习完成
      if(!in_array(0, $result))
      {
        $model = Unit::getRow($where);

        $model->is_finish = 1;
        $model->save();
      }

      $where = [
        'member_id'     => $member_id,
        'course_id'     => $course_id,
        'courseware_id' => $courseware_id,
        'level_id'      => $level_id,
      ];

      // 获取每位老师管理人数
      $unit = Unit::getPluck('is_finish', $where, false, false, true);

      $result = array_column($unit, 'value');

      // 如果课程单元知识点全部学习完成
      if(!in_array(0, $result))
      {
        $model = Course::getRow($where);

        $model->is_finish = 1;
        $model->save();

        // 完成课程获取棒棒糖
        // event(new LollipopEvent($course_id, 1));
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
