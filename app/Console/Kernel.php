<?php

namespace App\Console;


use Illuminate\Console\Command;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('trigerBulanan')->monthly(29, '19:59');
        $schedule->command(\App\Console\Commands\trigerBulanan::class)
        ->everyMinute();
        // ->monthlyOn(29, '19:55');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        // $this->commands = [
        //     \App\Console\Commands\trigerBulanan::class
        // ];
        require base_path('routes/console.php');
    }

    
}
