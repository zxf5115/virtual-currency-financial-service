<?php
namespace App\Listeners\Api\Information;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Information;
use App\Events\Api\Information\BrowseEvent;

/**
 * 资讯浏览监听器
 */
class BrowseListeners
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
   * @param  BrowseEvent  $event
   * @return void
   */
  public function handle(BrowseEvent $event)
  {
    try
    {
      $data_id  = $event->data_id;

      $model = Information::getRow(['id' => $data_id]);

      if(!empty($model->id))
      {
        $model->increment('read_total');
      }
      else
      {
        $model->read_total = 1;
        $model->save();
      }
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      record($e);

      return false;
    }
  }
}
