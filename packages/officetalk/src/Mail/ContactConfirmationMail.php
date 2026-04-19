<?php

declare(strict_types=1);

namespace Officetalk\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Officetalk\Models\ContactRequest;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequest $contactRequest,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bitte bestätigen Sie Ihre OfficeTalk-Anfrage',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'officetalk::emails.contact-confirmation',
            with: [
                'contactRequest' => $this->contactRequest,
                'confirmUrl' => $this->contactRequest->confirmationUrl(),
            ],
        );
    }
}
