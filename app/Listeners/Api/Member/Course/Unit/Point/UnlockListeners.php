<?php
namespace App\Listeners\Api\Member\Course\Unit\Point;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\Course\Unit\Point\UnlockEvent;
use App\Models\Api\Module\Member\Relevance\Relevance\Relevance\Point;

/**
 * 解锁课程单元知识点监听器
 */
class UnlockListeners
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
   * @param  UnlockEvent  $event
   * @return void
   */
  public function handle(UnlockEvent $event)
  {
    try
    {
      $member_id = $event->member_id;
      $point_id  = $event->point_id;

      $where = [
        'member_id' => $member_id,
        'id'        => $point_id
      ];

      // 获取学员知识点信息
      $point = Point::getRow($where);

      // 如果学员知识点不存在
      if(empty($point))
      {
        return false;
      }

      $where = [
        'member_id'     => $member_id,
        'course_id'     => $point->course_id,
        'courseware_id' => $point->courseware_id,
        'level_id'      => $point->level_id,
        'unit_id'       => $point->unit_id,
        'is_unlock'     => 0,
      ];

      $orders = [['key' => 'id', 'value' => 'asc']];

      $model = Point::getRow($where, false, false, $orders);

      if(empty($model))
      {
        return false;
      }

      $model->is_unlock   = 1;
      $model->unlock_time = time();
      $model->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
