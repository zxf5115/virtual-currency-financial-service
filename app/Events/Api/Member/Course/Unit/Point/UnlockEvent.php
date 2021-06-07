<?php
namespace App\Events\Api\Member\Course\Unit\Point;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 解锁课程单元知识点事件
 */
class UnlockEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $point_id = null;


  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($request)
  {
    $this->member_id = auth('api')->user()->id;
    $this->point_id  = $request['id'];
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
