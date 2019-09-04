<?php

namespace SavyCon\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use SavyCon\Models\User;

class NewUserOnSavycon extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, User $admin)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New User On SavyCon')
                ->view('emails.admin.newUser');
    }
}
