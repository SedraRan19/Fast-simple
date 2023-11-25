<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $token;
    public $resetLink;

    public function __construct($token, $resetLink)
    {
        $this->token = $token;
        $this->resetLink = $resetLink;
    }

    public function build()
    {
        // return $this->view('email.reset-password', compact('token', 'resetLink'));
        return $this->from('mail@alsasoft.fr')
                    ->subject('Reset password')
                    ->view('email.reset-password')
                    ->with([
                        'Tokem' => $this->token,
                        'link'=> $this->resetLink,
                    ]);
    }
}
