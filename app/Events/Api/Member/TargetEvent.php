<?php
namespace App\Events\Api\Member;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 成为老师目标事件
 */
class TargetEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $type      = null;
  public $member_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($member_id, $type)
  {
    $this->member_id = $member_id;
    $this->type      = $type;
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
