<?php

namespace SavyCon\Jobs\Mails\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use SavyCon\Models\User;

use Illuminate\Support\Facades\Mail;
use SavyCon\Mail\Admin\NewUserOnSavycon;

class InformAdminOfNewUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $user;
    public $admin;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, User $admin)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin)->send(new NewUserOnSavycon($this->user, $this->admin));
    }
}
