<?php

declare(strict_types=1);

namespace Officetalk\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Officetalk\Models\ContactRequest;

class ContactSummaryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactRequest $contactRequest,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ihre OfficeTalk-Anfrage – Zusammenfassung',
            bcc: [
                new Address('gerhard@weloveinteraction.com', 'Gerhard Popp'),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'officetalk::emails.contact-summary',
            with: [
                'contactRequest' => $this->contactRequest,
            ],
        );
    }
}
