<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SimpleBatch::class,
        Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('command:SimpleBatch')->everyMinute();
        $schedule->command('demo:cron')->everyMinute();
        // $schedule->command('command:SimpleBatch')->cron("*/1 * * * *")->runInBackground();
        print_r("execute schedule");
        $schedule->command('demo:cron')
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
