<?php
namespace App\Events\Api\Member\Course;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 添加课程单元知识点内容事件
 */
class UnitPointEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $course_id     = null;
  public $courseware_id = null;
  public $level_id      = null;
  public $member_id      = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($course_id, $courseware_id, $level_id, $member_id)
  {
    $this->course_id     = $course_id;
    $this->courseware_id = $courseware_id;
    $this->level_id      = $level_id;
    $this->member_id      = $member_id;
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
