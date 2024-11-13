<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Home;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Home::where('status', '=', 'Active')->get();
        $categories = Category::get();
        $brands = Brand::get();
        $products = Product::where('featured', 1)->with('images')->get();

        $top_selling = Product::join('customer_order_item', 'product.id', '=', 'customer_order_item.id')
        ->select(
            [
                'product.id',
                'product.name',
                'product.sprice',
                DB::raw(value: 'SUM(customer_order_item.quantity) as quantity'),
                DB::raw(value: 'product.sprice*(SUM(customer_order_item.quantity)) as sales'),
                DB::raw('(SELECT brand.name FROM brand WHERE product.brand_id = brand.id) as brand_name'),
            ])
            ->groupBy('product.id', 'product.name', 'product.sprice', 'product.brand_id')
            ->orderBy('sales', 'desc')
            ->get()
            ->take(10);

        $top_trending = Product::join('customer_order_item', 'product.id', '=', 'customer_order_item.id')
        ->select(
            [
                'product.id',
                'product.name',
                'product.sprice',
                DB::raw(value: 'SUM(customer_order_item.quantity) as quantity'),
                DB::raw(value: 'product.sprice*(SUM(customer_order_item.quantity)) as sales'),
                DB::raw('(SELECT brand.name FROM brand WHERE product.brand_id = brand.id) as brand_name'),
            ])
            ->groupBy('product.id', 'product.name', 'product.sprice', 'product.brand_id')
            ->orderBy('quantity', 'desc')
            ->get()
            ->take(10);

        return view('customer.page.main.home', [
            'banners' => $banners,
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'top_selling' => $top_selling,
            'top_trending' => $top_trending,

        ]);
    }
}
