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
 * 支付事件
 */
class PayEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $order = null;
  public $is_h5 = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($order, $is_h5 = false)
  {
    $this->order = $order;
    $this->is_h5 = $is_h5;
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
