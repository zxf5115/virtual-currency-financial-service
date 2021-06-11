<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Project;
use App\Events\Api\Member\ApprovalEvent;

/**
 * 项目点赞监听器
 */
class ApprovalListeners
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
   * @param  ApprovalEvent  $event
   * @return void
   */
  public function handle(ApprovalEvent $event)
  {
    try
    {
      $type       = $event->type;
      $project_id = $event->project_id;

      $project = Project::getRow(['id' => $project_id]);

      if(1 == $type)
      {
        $project->increment('approval_total', 1);
      }
      else
      {
        $project->decrement('approval_total', 1);
      }

      return true;
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      record($e);

      return false;
    }
  }
}
