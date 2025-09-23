<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends notifications to all the event attendes that event starts soon.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('attendees.user')
                ->whereBetween('start_time', [now(), now()->addDay()])
                ->get();

        $eventCount = $events->count();
        $eventLabel = \Str::plural('event', $eventCount);

        $events->each(
            fn($event) => $event->attendees->each(
                fn($attendee) => $this->info("Notifying the user {$attendee->user->id}")
            )
        );

        $this->info('Reminder notification send successfully!');
    }
}
