<?php

namespace App\Http\Livewire\Customer\Productcatalog;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToWishlist extends Component
{
    public $product;

    public $customer_id;

    public $showbutton = 0;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function AddToWishlist()
    {
        $this->customer_id = Auth::guard('customer')->user()->id;

        Wishlist::create([
            'customers_id' => $this->customer_id,
            'product_id' => $this->product->id,
        ]);
    }

    public function RemoveToWishlist()
    {
        $this->customer_id = Auth::guard('customer')->user()->id;
        Wishlist::where('customers_id', $this->customer_id)
        ->where('product_id', $this->product->id)->delete();
    }

    public function render()
    {
        if(Auth::guard('customer')->check()){
            $this->customer_id = Auth::guard('customer')->user()->id;

            $wishlist_checker = Wishlist::where('product_id', $this->product->id)
            ->where('customers_id', $this->customer_id)
            ->get()->count();
        }else{
            $wishlist_checker = [];
        }


        return view('livewire.customer.productcatalog.add-to-wishlist', [
            'wishlist_checker' => $wishlist_checker,
        ]);
    }
}
