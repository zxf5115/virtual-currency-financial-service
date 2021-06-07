<?php
namespace App\Listeners\Api\Member\Order;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Api\Member\Order\CourseEvent;
use App\Models\Api\Module\Education\Course\Course;

/**
 * 购买课程听器
 */
class CourseListeners
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
   * @param  CourseEvent  $event
   * @return void
   */
  public function handle(CourseEvent $event)
  {
    try
    {
      $course_id = $event->course_id;

      $course = Course::getRow(['id' => $course_id]);

      $course->increment('buy_total', 1);

      $course->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
