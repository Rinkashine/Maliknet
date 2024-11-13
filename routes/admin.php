<?php

//Admin Dashboard Import
use App\Http\Controllers\Backend\Auth\ChangePasswordController;
//Admin Controller Import
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LogoutController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\ResetController;
use App\Http\Controllers\Backend\Page\DashboardController;
use App\Http\Controllers\Backend\Page\ProfileController;
//Import Admin Product Related Stuff
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\InventoryController;
use App\Http\Controllers\Backend\Product\InventoryTransferController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\SupplierController;
//Import Admin Transaction Stuff
use App\Http\Controllers\Backend\Transaction\OrderController;
use App\Http\Controllers\Backend\Transaction\PostController;
use App\Http\Controllers\Backend\Users\CustomerController;
use App\Http\Controllers\Backend\Users\RoleController;
use App\Http\Controllers\Backend\Users\UsersController;


Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::resource('login', LoginController::class)->only(['index', 'store']);
    });

    Route::middleware(['auth:web'])->group(function () {
        //Begin: Export Files for Category
        Route::get('/category/pdf', [CategoryController::class, 'exportcategoriesexcel'])->name('exportcategoriespdf');
        //Begin: Export Files for Brand
        Route::get('/brand/pdf', [BrandController::class, 'exportbrandexcel'])->name('exportbrandpdf');
        //Begin: Export Files for Product
        Route::get('/product/pdf', [ProductController::class, 'exportproductexcel'])->name('exportproductpdf');
        //Begin:Export Files for Supplier
        Route::get('/supplier/pdf', [SupplierController::class, 'exportsupplierexcel'])->name('exportsupplierpdf');
        //Begin:Export Files for Role
        Route::get('/role/pdf', [RoleController::class, 'exportroleexcel'])->name('exportrolepdf');


        Route::middleware(['PreventBackHistory'])->group(function () {
            //Begin: Logout Module
            Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
            //Begin: Dashboard Module
            Route::resource('dashboard', DashboardController::class)->only(['index']);
            //Begin: Product Attribute Module
            Route::resource('brand', BrandController::class)->only(['index']);
            Route::resource('category', CategoryController::class)->only('index');
            //Begin: Inventory Module
            Route::resource('inventory', InventoryController::class)->except(['edit', 'show', 'create']);
            Route::get('product/inventory_history/{id}', [ProductController::class, 'ProductInventoryHistory'])->name('ProductInventoryHistory');
            //Begin: Purchase Order Module
            Route::resource('transfer', InventoryTransferController::class);
            Route::get('/receive/{id}', [InventoryTransferController::class, 'receive'])->name('inventory.receive');
            //Begin: Product Module
            Route::get('/product/archive', [ProductController::class, 'ProductArchiveIndex'])->name('ProductArchiveIndex');
            Route::delete('/product/archive/{id}', [ProductController::class, 'ProductArchiveDestroy']);
            Route::put('/product/archive/{id}', [ProductController::class, 'ProductArchiveRestore']);
            Route::get('/product/featuredproducts', [ProductController::class, 'FeaturedProductIndex'])->name('product.FeaturedProduct');
            Route::resource('product', ProductController::class);
            //Begin: Order
            Route::get('/orders/print_waybill/{id}',[OrderController::class, 'Invoice'])->name('invoice');
            Route::resource('orders', OrderController::class)->only('index', 'show');
            //End: Order Module
            Route::resource('banner', PostController::class)->only('index');
            //Begin: Supplier Module
            Route::get('/supplier/archive', [SupplierController::class, 'SupplierArchiveIndex'])->name('SupplierArchiveIndex');
            Route::resource('supplier', SupplierController::class);
            //Begin: Profile Module
            Route::get('/profile/changepassword', [ProfileController::class, 'changepass'])->name('AdminChangePass');
            Route::post('/profile/changepassword', [ProfileController::class, 'resetpass']);
            Route::resource('profile', ProfileController::class)->only('index');
            Route::resource('changepassword', ChangePasswordController::class)->only('index');
            //Begin: Customers Module
            Route::get('/customer/archive', [CustomerController::class, 'CustomerArchiveIndex'])->name('CustomerArchiveIndex');
            Route::resource('customer', CustomerController::class)->only('index', 'show');

            //Begin: Users Module
            Route::get('/user/archive', [UsersController::class, 'UserArchiveIndex'])->name('UserArchiveIndex');
            Route::resource('user', UsersController::class);
            Route::post('role/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('role/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
            Route::resource('role', RoleController::class);

        });
    });
});
