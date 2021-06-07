<?php
namespace App\Listeners\Api\Member\Production;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Production\Production;
use App\Events\Api\Member\Production\ApprovalEvent;

/**
 * 作品点赞监听器
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
      $type          = $event->type;
      $production_id = $event->production_id;

      $production = Production::getRow(['id' => $production_id]);

      if(1 == $type)
      {
        $production->increment('approval_total', 1);
      }
      else
      {
        $production->decrement('approval_total', 1);
      }

      $production->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
