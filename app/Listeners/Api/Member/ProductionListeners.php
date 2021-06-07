<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\ProductionEvent;
use App\Models\Common\Module\Member\Relevance\Asset;

/**
 * 作品监听器
 */
class ProductionListeners
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
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-24
   * ------------------------------------------
   * 记录用户上传作品数量
   * ------------------------------------------
   *
   * 记录用户上传作品数量
   *
   * @param ProductionEvent $event [description]
   * @return [type]
   */
  public function handle(ProductionEvent $event)
  {
    try
    {
      $user_id = auth('api')->user()->id;

      $asset = Asset::firstOrCreate(['member_id' => $user_id]);
      $asset->increment('production', 1);
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
