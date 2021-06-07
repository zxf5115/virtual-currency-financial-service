<?php
namespace App\Events\Api\Member\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 购买课程事件
 */
class CourseEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $course_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($course_id)
  {
    $this->course_id = $course_id;
  }

  /**
   * Get the channels the event should broadcast on.
   *
   * @return \Illuminate\Broadcasting\Channel|array
   */
  public function broadcastOn()
  {
      return new PrivateChannel('channel-name');
  }
}
