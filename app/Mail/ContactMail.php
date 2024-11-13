<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;

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
        return $this->subject($this->details['subject'])
        ->from('godentalph@gmail.com', 'Go Dental')
        ->markdown('customer.mail.contact-mail')
        ->with([
            'name' => $this->details['name'],
            'subject' => $this->details['subject'],
            'message' => $this->details['message'],
            'email' => $this->details['email'],
            'phone' => $this->details['phone'],

        ]);
    }
}
