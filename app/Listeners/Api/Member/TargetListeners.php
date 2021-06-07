<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\TargetEvent;
use App\Models\Api\Module\Member\Relevance\Target;

/**
 * 成为老师目标监听器
 */
class TargetListeners
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
   * @param  TargetEvent  $event
   * @return void
   */
  public function handle(TargetEvent $event)
  {
    try
    {
      $member_id = $event->member_id;
      $type      = $event->type;

      $where = ['member_id' => $member_id];

      $model = Target::firstOrNew($where);

      // 购买系统课
      if(1 == $type)
      {
        if(empty($model->id))
        {
          $model->course_total = 1;
        }
        else
        {
          $model->increment('course_total', 1);
        }
      }
      // 邀请别人购买体验课
      else if(2 == $type)
      {
        if(empty($model->id))
        {
          $model->invitation_total = 1;
        }
        else
        {
          $model->increment('invitation_total', 1);
        }
      }
      // 上传作品
      else
      {
        if(empty($model->id))
        {
          $model->upload_total = 1;
        }
        else
        {
          $model->increment('upload_total', 1);
        }
      }

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
