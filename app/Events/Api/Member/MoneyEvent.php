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
 * 佣金事件
 */
class MoneyEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $type      = null;
  public $money     = null;
  public $member_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($type, $money, $member_id)
  {
    $this->type      = $type;
    $this->money     = $money;
    $this->member_id = $member_id;
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
