<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductCatalogController extends Controller
{
    public function index()
    {
        $categories = Category::orderby('name')->get();
        $products = Product::where('status', 1)->orderBy('name')->with('images', 'category')->get()->shuffle();

        return view('customer.page.cart.product', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        return view('customer.page.cart.productshow', [
            'product' => $product,

        ]);
    }
}
