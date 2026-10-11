<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $contactData)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Form Submission',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
            with: [
                'fname' => $this->contactData['fname'] ?? '',
                'lname' => $this->contactData['lname'] ?? '',
                'email' => $this->contactData['email'] ?? '',
                'msg' => $this->contactData['msg'] ?? '',
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
