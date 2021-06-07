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
 * 完成课程单元学习事件
 */
class UnitFinishEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $member_id     = null;
  public $course_id     = null;
  public $courseware_id = null;
  public $level_id      = null;
  public $unit_id       = null;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct($model)
  {
    $this->member_id     = $model->member_id;
    $this->course_id     = $model->course_id;
    $this->courseware_id = $model->courseware_id;
    $this->level_id      = $model->level_id;
    $this->unit_id       = $model->unit_id;
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
