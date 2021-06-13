<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\Module\Project;
use App\Events\Api\Member\BrowseEvent;

/**
 * 浏览监听器
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

      $model = Project::firstOrNew(['id' => $data_id]);

      if(!empty($model->id))
      {
        $model->increment('browse_total');
      }
      else
      {
        $model->browse_total = 1;
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
