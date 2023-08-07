<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\Cronjob\SendReminder;
use App\Http\Controllers\Cronjob\FetchCollegeInformation;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call('App\Http\Controllers\Cronjob\SendReminder@index')->everyMinute();
        $schedule->call('App\Http\Controllers\Cronjob\OneTimeSubscription@index')->everyMinute();
        $schedule->call('App\Http\Controllers\Cronjob\FetchCollegeInformation@index')->daily();
        $schedule->call('App\Http\Controllers\Cronjob\CollegeMajorInformationc@index')->daily();
        $schedule->call('App\Http\Controllers\Cronjob\FreeSubscriptionController@index')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
