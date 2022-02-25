<?php

namespace Modules\Zoom\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Zoom\Entities\ZoomMeeting;

class MeetingInviteEvent
{
    use Dispatchable, InteractsWithSockets ,SerializesModels;

    public $meeting;
    public $notifyUser;
    public $cancel;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ZoomMeeting $meeting, $notifyUser, $cancel=false)
    {
        $this->meeting = $meeting;
        $this->cancel = $cancel;
        $this->notifyUser = $notifyUser;
    }
}
