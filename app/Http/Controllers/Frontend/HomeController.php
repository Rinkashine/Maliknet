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

        return view('customer.page.main.home', [
            'banners' => $banners,
        ]);
    }
}
