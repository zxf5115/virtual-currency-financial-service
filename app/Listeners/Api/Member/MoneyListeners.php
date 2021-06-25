<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\MoneyEvent;
use App\Models\Api\Module\Member\Asset;

/**
 * 金额监听器
 */
class MoneyListeners
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
   * @param  MoneyEvent  $event
   * @return void
   */
  public function handle(MoneyEvent $event)
  {
    try
    {
      $member_id = $event->member_id;
      $money     = $event->money;

      $asset = Asset::firstOrCreate(['member_id' => $member_id]);
      $asset->increment('money', $money);
      $asset->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
