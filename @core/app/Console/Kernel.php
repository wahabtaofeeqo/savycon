<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Jobs\PullAndPushData;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SubscriptionExpireReminder::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new PullAndPushData())->everyMinute();
        $schedule->command('package:subscription_expire')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
