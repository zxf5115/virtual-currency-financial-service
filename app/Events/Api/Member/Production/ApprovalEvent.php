<?php
namespace App\Events\Api\Member\Production;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 作品点赞事件
 */
class ApprovalEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $type = null;
  public $production_id = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($type, $production_id)
  {
    $this->type          = $type;
    $this->production_id = $production_id;
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
