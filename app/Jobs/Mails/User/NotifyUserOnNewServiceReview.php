<?php

namespace SavyCon\Jobs\Mails\User;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use SavyCon\Models\UserServiceRating;

use Illuminate\Support\Facades\Mail;
use SavyCon\Mail\User\NewServiceReview;

class NotifyUserOnNewServiceReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    public $review;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserServiceRating $review)
    {
        $this->review = $review;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->review->userService->user)->send(new NewServiceReview($this->review));
    }
}
