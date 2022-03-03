<?php

namespace App\Console;

use App\Mail\EventPreparation;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $events = Event::whereDate('lead_time', date("Y-m-d"))
                ->with('creator')->get();

            foreach ($events as $event) {
                $details = [
                    'name' => $event->creator->first_name,
                    'eventName' => $event->name,
                    'eventDate' => $event->event_date,
                    'activities' => $event->activities,
                ];
                Mail::to($event->creator->email)->send(new EventPreparation($details));
            }

        })->everyMinute();


        $schedule->call(function () {
            $events = Event::whereDate('event_date', date("Y-m-d"))
                ->with('frequency')->get();

            foreach ($events as $event) {
                $frequency = $event->frequency->name;
                if ($frequency == 'daily') {
                    $event->update(['event_date' => Carbon::now()->addDay()]);
                }
                if ($frequency == 'weekly') {
                    $event->update(['event_date' => Carbon::now()->addWeek()]);
                }
                if ($frequency == 'bi-weekly') {
                    $event->update(['event_date' => Carbon::now()->addWeeks(2)]);
                }
                if ($frequency == 'monthly') {
                    $event->update(['event_date' => Carbon::now()->addMonth()]);
                }
                if ($frequency == 'bi-monthly') {
                    $event->update(['event_date' => Carbon::now()->addMonths(2)]);
                }
                if ($frequency == 'annualy') {
                    $event->update(['event_date' => Carbon::now()->addYear()]);
                }
            }

        })->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
