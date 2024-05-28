<?php

namespace App\Listeners;

use App\Events\NewTourEvent;
use App\Mail\NewTourMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTourNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewTourEvent $event): void
    {
        Mail::to(config('mail.from.email'))->bcc(User::all())
            ->queue(new NewTourMail($event->tour));
    }
}
