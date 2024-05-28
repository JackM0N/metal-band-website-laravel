<?php

namespace App\Listeners;

use App\Events\NewAlbumEvent;
use App\Mail\NewAlbumMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAlbumNotification
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
    public function handle(NewAlbumEvent $event): void
    {
        Mail::bcc(User::all())
            ->queue(new NewAlbumMail($event->album));
    }
}
