<?php

namespace App\Http\Livewire\Customer\Review;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class ProductReviewForm extends Component
{
    public $orderDetails;

    public $comment = '';

    public $rate = 1;

    public $productId;

    public $productName;

    protected $listeners = ['selectProductToReview'];

    public function mount($orderDetails)
    {
        $this->orderDetails = $orderDetails;
    }

     public function CreateReview()
     {
         $customer_id = Auth::guard('customer')->user()->id;

         Review::create([
             'customer_id' => $customer_id,
             'customer_order_item_id' => $this->productId,
             'comment' => $this->comment,
             'customer_order_id' => $this->orderDetails->id,
             'rate' => $this->rate,
         ])
             ->save();

         $this->dispatchBrowserEvent('CloseReviewModal');
         Alert::success('Product has been reviewed!', 'Thank you for your feedback!');

         return redirect()->route('order.show', $this->orderDetails->id);
     }

  public function selectProductToReview($productName, $productId)
  {
      $this->productId = $productId;
      $this->productName = $productName;

      $this->dispatchBrowserEvent('ShowReviewModal');
  }

   public function setRate($rate)
   {
       $this->rate = $rate;
       $this->dispatchBrowserEvent('RenderRating', [
           'rate' => $rate,
       ]);
   }

    public function render()
    {
        return view('livewire.customer.review.product-review-form');
    }
}
