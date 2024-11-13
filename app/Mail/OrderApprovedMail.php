<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;
use App\Models\CustomerOrderItems;
class OrderApprovedMail extends Mailable
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
        $customer = Customer::findorfail($this->details['customers_id']);
        $listofordereditems = CustomerOrderItems::where('customer_order_id',$this->details['id'])->get();
        return $this->subject('Order Being Processed #'.$this->details['id'])
        ->from('markjosephmanalo1110@gmail.com', 'Maliknet')
        ->markdown('admin.mail.order-approved')
        ->with([
            'name' => $customer->name,
            'orderid' => $this->details['id'],
            'updated_at' => $this->details['updated_at'],
            'payment_method' => $this->details['mode_of_payment'],
            'receiver_name' => $this->details['received_by'],
            'receiver_phone' => $this->details['phone_number'],
            'receiver_address' => $this->details['house'],
            'items' => $listofordereditems,
            'shipping_fee' => $this->details['shippingfee']
        ]);
    }
}
