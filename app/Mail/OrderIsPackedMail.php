<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomerOrder;
use App\Models\Customer;
class OrderIsPackedMail extends Mailable
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
        return $this->subject('Your Go Dental Order is ready for delivery')
        ->from('godentalph@gmail.com', 'Go Dental')
        ->view('admin.mail.order-packed')
        ->with([
           'name' => $orderinfo->customers->name,
           'order_id' => $this->details['id'],
           'items' => $orderinfo->orderTransactions,

        ]);
    }
}
