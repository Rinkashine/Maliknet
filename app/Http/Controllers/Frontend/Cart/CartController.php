<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Models\CustomerCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        return view('customer.page.cart.cart');
    }

    public function addToCart(Request $request)
    {
        try {
            $customer_id = Auth::id();
            $itemAlreadyOnCart = CustomerCart::where('product_id', $request->id)->where('customers_id', $customer_id)->exists();
            if ($itemAlreadyOnCart) {
                CustomerCart::where('product_id', $request->id)->where('customers_id', $customer_id)->increment('quantity', $request->quantity);
            } else {
                CustomerCart::create(['customers_id' => $customer_id, 'product_id' => $request->id, 'quantity' => $request->quantity]);
            }

            return json_encode(['message' => 'Item successfully added to cart', 'status' => 200]);
        } catch(Exception $e) {
            return json_encode(['error' => $e, 'status' => 500]);
        }
    }
}
