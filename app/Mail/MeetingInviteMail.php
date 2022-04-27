<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $meeting;
    public $notifyUser;
    public $cancel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meeting, $notifyUser, $cancel)
    {
        $this->meeting = $meeting;
        $this->notifyUser = $notifyUser;
        $this->cancel = $cancel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (!$this->cancel) {
            return $this->view('view.mail.meeting.invite');
        }else{
            return $this->view('view.mail.meeting.cancel');
        }
    }
}
