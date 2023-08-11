<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_name;
    public $token;
    /**
     * Create a new message instance.
     */
    public function __construct($user_name, $token)
    {
        $this->user_name = $user_name;
        $this->token = $token;
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->markdown('emails.auth.forget_password_mail')->with([
            'user_name' => $this->user_name,
            'token' => $this->token
        ]);
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
