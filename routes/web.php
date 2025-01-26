<?php

use App\Http\Controllers\ColorSchemeController;
//Dark Mode and Color Switcher Import
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\Frontend\Account\CustomerCancellationController;
//Import Customer Page(About Us, Frequently Asked Question, Contact Page)
use App\Http\Controllers\Frontend\Account\CustomerOrdersController;
use App\Http\Controllers\Frontend\Account\CustomerReturnsController;
//Transactions Controller
use App\Http\Controllers\Frontend\Account\CustomerReviewsController;
use App\Http\Controllers\Frontend\Account\CustomerWishlistController;

//Import Customer Account Controller
use App\Http\Controllers\Frontend\Auth\CustomerLogoutController;
use App\Http\Controllers\Frontend\Auth\CustomerProfileController;
use App\Http\Controllers\Frontend\Auth\CustomerRegisterController;
use App\Http\Controllers\Frontend\Auth\CustomerResetController;
use App\Http\Controllers\Frontend\Cart\CartController;
//Import Customer Product and Cart ShippingController
use App\Http\Controllers\Frontend\Cart\ProductCatalogController;
use App\Http\Controllers\Frontend\HomeController;
//Import Order History
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\Transaction\CheckoutController;
use App\Http\Controllers\Frontend\Transaction\ContactController;
use App\Http\Controllers\Frontend\Transaction\ShippingController;
use Illuminate\Support\Facades\Route;
//Auth Controller
use App\Http\Controllers\Frontend\Auth\CustomerLoginController;
use App\Http\Controllers\Frontend\Auth\ProviderController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/{provider}/redirect',[ProviderController::class,'redirect'])->name('redirect');
Route::get('/auth/{provider}/callback',[ProviderController::class,'callback']);

//Dark Mode Switcher Route
Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
//Color Mode Switcher Route
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::middleware(['PreventBackHistory'])->group(function () {
    Route::get('/', function () {
        return view('customer.page.main.home');
    });

    Route::get('/', [Homecontroller::class, 'index'])->name('home');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('sendemailcontact');

    Route::get('/productcatalog', [ProductCatalogController::class, 'index'])->name('product');
    Route::get('/productcatalog/{product:id}', [ProductCatalogController::class, 'show'])->name('productshow');
    Route::get('/product/cart');
    Route::get('/verify', [CustomerRegisterController::class, 'verify'])->name('verify');

    Route::middleware(['guest:customer'])->group(function () {
        Route::resource('CLogin', CustomerLoginController::class)->only(['index', 'store']);
        Route::resource('resetcustomer', CustomerResetController::class)->only(['index', 'store']);
        Route::get('resetcustomer/password/{token}', [CustomerResetController::class, 'ShowResetForm'])->name('customer.reset.password.form');
        Route::post('resetcustomer/password', [CustomerResetController::class, 'ResetPassword'])->name('customer.reset.password');
    });

    Route::middleware(['auth:customer'])->group(function () {
        Route::resource('cart', CartController::class)->only(['index', 'store']);
        Route::post('/product/cart/', [CartController::class, 'addToCart']);

        Route::get('/CLogout', [CustomerLogoutController::class, 'store'])->name('CLogout');

        Route::middleware(['is_customer_verify_email'])->group(function () {
            Route::resource('checkout', CheckoutController::class)->only(['index', 'store']);

            Route::get('/shipping', [ShippingController::class, 'index'])->name('shipping');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/profile', [CustomerProfileController::class, 'index'])->name('customer.profile');
            Route::get('/verifyemail', [CustomerProfileController::class, 'VerifyAccount'])->name('customer.verify');

            Route::get('/address', [CustomerProfileController::class, 'address'])->name('customer.address');
            Route::get('/address/create', [CustomerProfileController::class, 'createaddress'])->name('customer.address.create');
            Route::post('address/create', [CustomerProfileController::class, 'saveaddress']);
            Route::get('/address/edit/{id}', [CustomerProfileController::class, 'editaddress'])->name('customer.address.edit');
            Route::post('/address/edit/{id}', [CustomerProfileController::class, 'updateaddress']);
            Route::post('/address/default/{id}', [CustomerProfileController::class, 'setdefaultaddress'])->name('setdefaultaddress');
            Route::delete('/address/{id}', [CustomerProfileController::class, 'destroyaddress']);
            Route::get('/changepassword', [CustomerProfileController::class, 'changepassword'])->name('customer.change.pass');
            Route::post('changepassword', [CustomerProfileController::class, 'resetpass']);
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::resource('order', CustomerOrdersController::class)->only('index', 'show');
            Route::resource('returns', CustomerReturnsController::class)->only('index', 'show');
            Route::resource('reviews', CustomerReviewsController::class)->only('index', 'show');
            Route::resource('cancellations', CustomerCancellationController::class)->only('index', 'show');
            Route::resource('wishlist', CustomerWishlistController::class)->only('index');
        });
    });
});
