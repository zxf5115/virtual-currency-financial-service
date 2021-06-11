<?php
namespace App\Listeners\Api\Flash;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Production\Production;
use App\Events\Api\Member\Production\BenefitEvent;

/**
 * 作品点赞监听器
 */
class BenefitListeners
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
   * @param  BenefitEvent  $event
   * @return void
   */
  public function handle(BenefitEvent $event)
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
