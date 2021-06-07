<?php
namespace App\Listeners\Api\Member\Course\Unit;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Education\Course\Course;
use App\Events\Api\Member\Course\Unit\UnlockEvent;
use App\Models\Api\Module\Member\Relevance\Relevance\Unit;
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
      $member_id     = $event->member_id;
      $course_id     = $event->course_id;
      $courseware_id = $event->courseware_id;
      $level_id      = $event->level_id;

      $where = [
        'member_id'     => $member_id,
        'course_id'     => $course_id,
        'courseware_id' => $courseware_id,
        'level_id'      => $level_id,
      ];

      // 获取每位老师管理人数
      $course = Course::getRow(['id' => $course_id], ['unlock']);

      // 如果课程不存在或者课程解锁模式不存在
      if(empty($course) || empty($course->unlock))
      {
        return false;
      }

      // 课程开始时间
      $course_start_time = strtotime($course->course_start_time);

      if(empty($course_start_time) || time() < $course_start_time)
      {
        return false;
      }

      // 解锁课程单元知识点数
      $section = $course->unlock->section;

      // 解锁课程单元知识点时长
      $duration = $course->unlock->duration;

      $condition = [
        'is_unlock' => 1
      ];

      // 查看当前课程单元知识点解锁数据
      $unlockWhere = array_merge($where, $condition);

      $orders = [['key' => 'unlock_time', 'value' => 'desc']];

      $unlock = Unit::getRow($unlockWhere, false, false, $orders);

      // 计数器
      $i = 0;

      // 课程单元知识点都未解锁，直接解锁
      if(empty($unlock))
      {
        $this->handleUnlock($where, $section, $i);

        $this->handlePointUnlock($where);
      }
      // 如果最后一次解锁时间比设置解锁时长短，进行解锁
      else if($unlock->wait_unlock_time < time())
      {
        $condition = [
          'is_unlock' => 0
        ];

        // 获取未解锁的课程单元知识点
        $lockWhere = array_merge($where, $condition);

        $this->handleUnlock($lockWhere, $section, $i, true);
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-05
   * ------------------------------------------
   * 课程单元解锁
   * ------------------------------------------
   *
   * 根据条件对课程单元进行解锁
   *
   * @param [type] $where 解锁条件
   * @return [type]
   */
  private function handleUnlock($where, $section, $i, $next = false)
  {
    try
    {
      // $orders = [['key' => 'sort', 'value' => 'desc']];
      $unit = Unit::getList($where);

      // 课程单元知识点解锁
      foreach($unit as $k => $model)
      {
        if($i == $section)
        {
          return true;
        }

        $i++;
        $model->is_unlock   = 1;
        $model->unlock_time = time();
        $model->save();

        // 如果是下一级单元
        if($next)
        {
          $this->handleNextUnitPointUnlock($where, $model->unit_id);
        }
      }
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-05
   * ------------------------------------------
   * 课程单元知识点解锁
   * ------------------------------------------
   *
   * 根据条件对课程单元知识点进行解锁
   *
   * @param [type] $where 解锁条件
   * @return [type]
   */
  private function handlePointUnlock($where)
  {
    try
    {
      $order = [['key' => 'id', 'value' => 'asc']];

      $model = Point::getRow($where, false, false, $order);

      if(empty($model))
      {
        return false;
      }

      $model->is_unlock   = 1;
      $model->unlock_time = time();
      $model->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-05
   * ------------------------------------------
   * 课程单元知识点解锁
   * ------------------------------------------
   *
   * 根据条件对课程单元知识点进行解锁
   *
   * @param [type] $where 解锁条件
   * @return [type]
   */
  private function handleNextUnitPointUnlock($where, $unit_id)
  {
    try
    {
      $condition = ['unit_id' => $unit_id];

      $order = [['key' => 'id', 'value' => 'asc']];

      $where = array_merge($where, $condition);

      $model = Point::getRow($where, false, false, $order);

      if(empty($model))
      {
        return false;
      }

      $model->is_unlock   = 1;
      $model->unlock_time = time();
      $model->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
