<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Maliknet Reset Password')
        ->markdown('customer.mail.forgot-pass')
        ->from('webernet24@gmail.com', 'Maliknet')
        ->with([
            'email' => $this->details['email'],
            'action_link' => $this->details['action_link'],
        ]);
    }
}
