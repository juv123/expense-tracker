<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Example: $schedule->command('inspire')->hourly();
    }

    /**
     * Register any closures for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Register any artisan commands
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
