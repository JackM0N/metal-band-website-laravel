<?php

namespace App\Mail;

use App\Models\Album;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class NewAlbumMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $album;

    /**
     * Create a new message instance.
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('project@team.com', 'Project Team'),
            subject: __('albums.email_notification.subject', [
                'title' => $this->album->name
            ]),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.newAlbum', 
            with: [
                'title' => __('albums.email_notification.subject', [
                    'title' => $this->album->name
                ]),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
