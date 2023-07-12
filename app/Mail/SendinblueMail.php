<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendinblueMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $email_data;
    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->email_data = $data;
    }

    /**
     * Get the message envelope.
     */
    /*public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Sendinblue Mail',
        );
    }*/

    /**
     * Get the message content definition.
     */
    /*public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    /*public function attachments(): array
    {
        return [];
    }*/

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->email_data['subject'] ?? __('An email from ' ). env('APP_NAME');
        return $this->subject($subject)
            ->view('emails.sendinblue');
    }

}
