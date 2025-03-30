<?php

use App\Http\Controllers\Backend\Reports\ReportController;
use App\Http\Controllers\Backend\Reports\BrowserTypeController;
use App\Http\Controllers\Backend\Reports\MostVisitedPageController;
use App\Http\Controllers\Backend\Reports\UserTypeController;
use App\Http\Controllers\Backend\Reports\GenderController;
use App\Http\Controllers\Backend\Reports\PaymentByTypeController;
use App\Http\Controllers\Backend\Reports\MonthlySalesController;
use App\Http\Controllers\Backend\Reports\SalesByProductController;
use App\Http\Controllers\Backend\Reports\CustomerTotalSpentController;
use App\Http\Controllers\Backend\Reports\SalesByCategoryController;
use App\Http\Controllers\Backend\Reports\SalesByBrandController;
use App\Http\Controllers\Backend\Reports\BrandOrderVolumeController;
use App\Http\Controllers\Backend\Reports\CategoryVolumeController;
use App\Http\Controllers\Backend\Reports\CancelledOrderController;
use App\Http\Controllers\Backend\Reports\CancellationOverTimeController;
use App\Http\Controllers\Backend\Reports\MonthlyCancellationController;
use App\Http\Controllers\Backend\Reports\CancellationReasonController;
use App\Http\Controllers\Backend\Reports\NumberRejectedOrderController;
use App\Http\Controllers\Backend\Reports\CustomersGainedPerMonthController;
use App\Http\Controllers\Backend\Reports\AccountVerificationController;
use App\Http\Controllers\Backend\Reports\VerifiedAccountController;
use App\Http\Controllers\Backend\Reports\NonVerifiedAccountController;
use App\Http\Controllers\Backend\Reports\QuantityProductsOrderedController;
use App\Http\Controllers\Backend\Reports\ProductBuyerController;
use App\Http\Controllers\Backend\Reports\CustomerOrderVolume;
use App\Http\Controllers\Backend\Reports\CustomerBoughtProductController;
use App\Http\Controllers\Backend\Reports\ProductRatingController;
use App\Http\Controllers\Backend\Reports\RatingsByCustomerController;
use App\Http\Controllers\Backend\Reports\CustomerGainedPerMonthListController;
use App\Http\Controllers\Backend\Reports\ProductOrderVolumeController;
use App\Http\Controllers\Backend\Reports\YearlySalesController;


Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth:web'])->group(function () {


        Route::prefix('report')->group(function () {
            // Reports with optional startdate and enddate
            Route::get('/UserType/{startdate?}/{enddate?}/pdf', [UserTypeController::class, 'exportUserType'])->name('export.UserType');
            Route::get('/PaymentByType/pdf/{startdate?}/{enddate?}', [PaymentByTypeController::class, 'exportPaymentByType'])->name('export.PaymentType');
            Route::get('/ProductRatings/pdf/{sorting}/{startdate?}/{enddate?}', [ProductRatingController::class, 'exportProductRatings'])->name('export.ProductRatings');
            Route::get('/ProductRatings/ProductRatingsByCustomer/pdf/{sorting}/{startdate?}/{enddate?}/{name}', [RatingsByCustomerController::class, 'exportProductRatingsByCustomer'])->name('export.ProductRatingsByCustomer');
            Route::get('/salesprod/pdf/{sorting}/{startdate?}/{enddate?}', [SalesByProductController::class, 'exportProductSales'])->name('export.ProductSales');
            Route::get('/CategorySales/pdf/{sorting}/{startdate?}/{enddate?}', [SalesByCategoryController::class, 'exportCategorySales'])->name('export.CategorySales');
            Route::get('/CategoryVolume/pdf/{sorting}/{startdate?}/{enddate?}', [CategoryVolumeController::class, 'exportCategoryVolume'])->name('export.CategoryVolume');
            Route::get('/CustomerExpenditure/pdf/{sorting}/{startdate?}/{enddate?}', [CustomerTotalSpentController::class, 'exportCustomerTotalSpent'])->name('export.CustomerTotalSpent');

            // Reports without date parameters
            Route::get('/cancelledorders/pdf', [CancelledOrderController::class, 'exportCancelledOrders'])->name('export.CancelledOrders');
            Route::get('/cancellationreasons/pdf', [CancellationReasonController::class, 'exportCancellationReason'])->name('export.CancellationReason');
            Route::get('/rejectedorders/pdf', [NumberRejectedOrderController::class, 'exportRejectedOrders'])->name('export.RejectedOrders');
            Route::get('/cancellationovertime/pdf', [CancellationOverTimeController::class, 'exportCancellationOverTime'])->name('export.CancellationOverTime');
            Route::get('/monthlycancellation/pdf/{month}/{year}', [MonthlyCancellationController::class, 'exportMonthlyCancellation'])->name('export.MonthlyCancellation');
            Route::get('/MonthlyGainedCustomer/pdf', [CustomersGainedPerMonthController::class, 'exportMonthlyGainedCustomers'])->name('export.MonthlyGainedCustomers');
            Route::get('/MonthlyGainedCustomer/{from}/{to}/pdf', [CustomerGainedPerMonthListController::class, 'exportCustomerPerMonthList'])->name('export.ShowMonthlyGainedCustomers');
            Route::get('/productbycustomer/pdf/', [ProductBuyerController::class, 'exportProductByCustomer'])->name('export.ProductByCustomer');
            Route::get('/VerifiedAccount/pdf/{sorting}', [VerifiedAccountController::class, 'exportVerifiedAccountsExcel'])->name('report.exportVerifiedAccountsExcel');
            Route::get('/NonVerifiedAccount/pdf/{sorting}', [NonVerifiedAccountController::class, 'exportNonVerifiedAccount'])->name('export.NonVerifiedAccount');
            Route::get('/ProductOrderVolume/pdf/{sorting}', [ProductOrderVolumeController::class, 'exportProductOrderVolume'])->name('export.ProductOrderVolume');
            Route::get('/CustomerOrderVolume/pdf/{sorting}', [CustomerOrderVolume::class, 'exportCustomerOrderVolume'])->name('export.CustomerOrderVolume');
            Route::get('/customerbyproduct/pdf/{name}', [CustomerBoughtProductController::class, 'exportCustomerByProduct'])->name('export.CustomerByProduct');
            Route::get('/MonthlySales/pdf', [MonthlySalesController::class, 'exportMonthlySales'])->name('export.MonthlySales');
            Route::get('/accountverification/pdf', [AccountVerificationController::class, 'exportAccountVerification'])->name('export.AccountVerification');
            Route::get('/YearlySales/pdf', [YearlySalesController::class, 'exportYearlySales'])->name('export.YearlySales');
        });
        Route::middleware(['PreventBackHistory'])->group(function () {
            //Begin: Reports Table
            Route::resource('report', ReportController::class)->only(['index']);
            //Begin: Yearly Sales
            Route::get('/report/YearlySales', [YearlySalesController::class, 'YearlySales'])->name('report.YearlySales');
            //Begin: Cancelled Orders
            Route::get('/report/cancelledorders',[CancelledOrderController::class,'CancelledOrders'])->name('report.CancelledOrders');
            //Begin: Cancellation Reasons
            Route::get('/report/cancellationreasons',[CancellationReasonController::class,'CancellationReasons'])->name('report.CancellationReasons');
            //Begin: Reject Orders
            Route::get('/report/rejectedorders',[NumberRejectedOrderController::class,'RejectedOrders'])->name('report.RejectedOrders');
           //Begin: Cancellation Over Time
           Route::get('/report/cancellationovertime',[CancellationOverTimeController::class,'CancellationOverTime'])->name('report.CancellationOverTime');
           //Begin: Monthly Cancellation
           Route::get('/report/monthlycancellation/{month}/{year}', [MonthlyCancellationController::class,'MonthlyCancellation'])->name('report.MonthlyCancellation');
           //Begin: Customer Per Month
           Route::get('/report/MonthlyGainedCustomer',[CustomersGainedPerMonthController::class,'customerPerMonth'])->name('report.customerPerMonth');
           //Begin: List of Customer Per Month
           Route::get('/report/MonthlyGainedCustomer/{month}/{year}', [CustomerGainedPerMonthListController::class,'CustomerPerMonthList'])->name('report.ShowCustomerPerMonth');
           //Begin: Payment By Type
           Route::get('/report/PaymentByType', [PaymentByTypeController::class, 'PaymentTypeIndex'])->name('report.PaymentByType');
           //Begin: Sales Over Time
           Route::get('/report/MonthlySales', [MonthlySalesController::class, 'SalesOvertimeIndex'])->name('report.MonthlySales');
           //Begin: Account Verification
           Route::get('/report/accountverification',[AccountVerificationController::class,'AccountVerification'])->name('report.AccountVerification');
           //Begin: Verified Accounts
           Route::get('/report/VerifiedAccount',[VerifiedAccountController::class,'VerifiedAccount'])->name('report.VerifiedAccount');
           //Begin: Non Verified Accounts
           Route::get('/report/NonVerifiedAccount',[NonVerifiedAccountController::class,'NonVerifiedAccount'])->name('report.NonVerifiedAccount');
           //Begin: Orders By Product
           Route::get('/report/ProductOrderVolume',[ProductOrderVolumeController::class,'ProductOrderVolume'])->name('report.ProductOrderVolume');
           //Begin:
           Route::get('/report/ProductOrderVolume/ProductByCustomer/{name}',[ProductBuyerController::class,'ProductByCustomer'])->name('report.ProductByCustomer');
           //Begin:
           Route::get('/report/CustomerOrderVolume',[CustomerOrderVolume::class,'CustomerOrderVolume'])->name('report.CustomerOrderVolume');
           //Begin:
           Route::get('/report/CustomerOrderVolume/{name}',[CustomerBoughtProductController::class,'CustomerByProduct'])->name('report.CustomerByProduct');
           //Begin:
           Route::get('/report/ProductRatings',[ProductRatingController::class,'ProductRatings'])->name('report.ProductRatings');
           //Begin:
           Route::get('/report/ProductRatings/{product_id}/{product_name}',[RatingsByCustomerController::class,'ProductRatingsByCustomer'])->name('report.ProductRatingsByCustomer');
           //Begin:
           Route::get('/report/ProductSales', [SalesByProductController::class, 'SalesByProductIndex'])->name('report.ProductSales');
           //Begin:
           Route::get('/report/CustomerExpenditure', [CustomerTotalSpentController::class, 'CustomersTotalSpent'])->name('report.CustomersTotalSpent');
           //Begin:
           Route::get('/report/CategorySales', [SalesByCategoryController::class, 'CategorySalesIndex'])->name('report.CategorySales');
           //Begin:
           Route::get('/report/CategoryVolume', [CategoryVolumeController::class, 'CategoryVolumeIndex'])->name('report.CategoryVolume');

        });

    });
});

