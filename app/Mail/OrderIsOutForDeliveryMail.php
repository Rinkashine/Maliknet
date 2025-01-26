<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomerOrder;

class OrderIsOutForDeliveryMail extends Mailable
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
        $orderinfo = CustomerOrder::find($this->details['id']);
        return $this->subject('Your Maliknet Order is Out For Delivery')
        ->from('markjosephmanalo1110@gmail.com', 'Maliknet')
        ->view('admin.mail.order-out-for-delivery')
        ->with([
           'name' => $orderinfo->customers->name,
           'order_id' => $this->details['id'],
           'items' => $orderinfo->orderTransactions,

        ]);
    }
}
