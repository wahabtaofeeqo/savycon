<?php

namespace SavyCon\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use SavyCon\Models\User;
use SavyCon\Models\UserServiceMessage;

class NewUserServiceMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $admin, UserServiceMessage $msg)
    {
        $this->admin = $admin;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Message For User Service')
                ->view('emails.admin.services.message');
    }
}
