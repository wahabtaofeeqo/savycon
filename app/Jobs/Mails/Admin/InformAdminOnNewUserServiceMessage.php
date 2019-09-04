<?php

namespace SavyCon\Jobs\Mails\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use SavyCon\Models\User;
use SavyCon\Models\UserServiceMessage;

use Illuminate\Support\Facades\Mail;
use SavyCon\Mail\Admin\NewUserServiceMessage;

class InformAdminOnNewUserServiceMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $admin;
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $admin, UserServiceMessage $message)
    {
        $this->admin = $admin;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin)->send(new NewUserServiceMessage($this->admin, $this->message));
    }
}
