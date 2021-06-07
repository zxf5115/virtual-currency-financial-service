<?php
namespace App\Listeners\Api\Member\Order;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Goods\Goods;
use App\Events\Api\Member\Order\GoodsEvent;


/**
 * 购买商品监听器
 */
class GoodsListeners
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
   * @param  GoodsEvent  $event
   * @return void
   */
  public function handle(GoodsEvent $event)
  {
    try
    {
      $goods_id    = $event->goods_id;

      $goods = Goods::getRow(['id' => $goods_id]);

      $goods->increment('exchange_total', 1);

      $goods->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
