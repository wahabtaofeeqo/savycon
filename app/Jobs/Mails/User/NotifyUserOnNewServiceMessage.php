<?php

namespace SavyCon\Jobs\Mails\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use SavyCon\Models\UserServiceMessage;

use Illuminate\Support\Facades\Mail;
use SavyCon\Mail\User\NewServiceMessage;

class NotifyUserOnNewServiceMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserServiceMessage $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->message->userService->user)->send(new NewServiceMessage($this->message));
    }
}
