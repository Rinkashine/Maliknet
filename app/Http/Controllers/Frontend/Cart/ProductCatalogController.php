<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductCatalogController extends Controller
{
    public function show(Product $product)
    {
        return view('customer.page.cart.productshow', [
            'product' => $product,

        ]);
    }
}
