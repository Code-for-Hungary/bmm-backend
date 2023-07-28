<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Subscription $subscription,
        protected string $eventContent
    ) {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        switch ($this->subscription->event->type) {
            case 1:
                $subject = 'Figyusz! Találat a "' . $this->subscription->event->parameters . '" kulcsszavadra!';
                break;
            case 2:
                $subject = 'Figyusz! Új adat a "' . $this->subscription->event->eventgenerator->name . '"-ben.';
                break;
            default:
                $subject = 'Figyusz!';
                break;
        }
        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscriptionnotification',
            with: [
                'eventgenerator' => $this->subscription->event->eventgenerator->name,
                'parameter' => $this->subscription->event->parameters,
                'eventtype' => $this->subscription->event->type,
                'eventcontent' => $this->eventContent,
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
