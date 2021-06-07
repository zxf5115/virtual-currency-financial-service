<?php
namespace App\Events\Api\Member;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * 棒棒糖事件
 */
class LollipopEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $course_id = null;
  public $unit_id   = null;
  public $mode      = null;
  public $type      = null;
  public $goods_id  = null;
  public $total     = null;


  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($course_id, $unit_id, $mode, $type, $goods_id = 0, $total = 0)
  {
    $this->course_id = $course_id;
    $this->unit_id   = $unit_id;
    $this->mode      = $mode;
    $this->type      = $type;
    $this->goods_id  = $goods_id;
    $this->total     = $total;
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
