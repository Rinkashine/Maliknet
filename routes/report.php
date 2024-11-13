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
        //Begin: Export Files for Browser Type
        Route::get('/report/browser/{startdate}/{enddate}/pdf', [BrowserTypeController::class, 'exportbrowsertype'])->name('export.browser');
        //Begin: Export Files for User Type
        Route::get('/report/UserType/{startdate}/{enddate}/pdf', [UserTypeController::class, 'exportUserType'])->name('export.UserType');
        //Begin: Export Files for List of Most Visited Page
        Route::get('/report/MostVisitedPage/{startdate}/{enddate}/pdf/', [MostVisitedPageController::class, 'exportMostVisitedPage'])->name('export.MostVisitedPage');
        //Begin: Export Files for Number of Cancelled Orders
        Route::get('/report/cancelledorders/pdf',[CancelledOrderController::class,'exportCancelledOrders'])->name('export.CancelledOrders');
        //Begin: Export Files  for Cancellation Reason
        Route::get('/report/cancellationreasons/pdf',[CancellationReasonController::class,'exportCancellationReason'])->name('export.CancellationReason');
        //Begin: Export Files for Number of Reject Orders
        Route::get('/report/rejectedorders/pdf',[NumberRejectedOrderController::class,'exportRejectedOrders'])->name('export.RejectedOrders');
        //Begin: Export Files for Number of cancelled orders overtime
        Route::get('/report/cancellationovertime/pdf',[CancellationOverTimeController::class,'exportCancellationOverTime'])->name('export.CancellationOverTime');
        //Begin: Export Files for Monthly Cancellation Reports
        Route::get('/report/monthlycancellation/pdf/{month}/{year}',[MonthlyCancellationController::class,'exportMonthlyCancellation'])->name('export.MonthlyCancellation');
        //Begin: Export Files for Numbers of Created Customers Per Month
        Route::get('/report/MonthlyGainedCustomer/pdf',[CustomersGainedPerMonthController::class,'exportMonthlyGainedCustomers'])->name('export.MonthlyGainedCustomers');
        //Begin: Export Files for List of Customers Created between that month
        Route::get('/report/MonthlyGainedCustomer/{from}/{to}/pdf',[CustomerGainedPerMonthListController::class,'exportCustomerPerMonthList'])->name('export.ShowMonthlyGainedCustomers');
        //Begin: Export Files for Number of Products Bought by the Customer
        Route::get('/report/productbycustomer/pdf/',[ProductBuyerController::class,'exportProductByCustomer'])->name('export.ProductByCustomer');
        //Begin: Export Files for Number of Verified Accounts
        Route::get('/report/VerifiedAccount/pdf/{sorting}',[VerifiedAccountController::class,'exportVerifiedAccountsExcel'])->name('report.exportVerifiedAccountsExcel');
        //Begin: Export Files for Non Verified Accounts
        Route::get('/report/NonVerifiedAccount/pdf/{sorting}',[NonVerifiedAccountController::class,'exportNonVerifiedAccount'])->name('export.NonVerifiedAccount');
        //Begin:
        Route::get('/report/ProductOrderVolume/pdf/{sorting}',[ProductOrderVolumeController::class,'exportProductOrderVolume'])->name('export.ProductOrderVolume');
        //Begin:
        Route::get('/report/CustomerOrderVolume/pdf/{sorting}',[CustomerOrderVolume::class,'exportCustomerOrderVolume'])->name('export.CustomerOrderVolume');
        //Begin:
        Route::get('/report/customerbyproduct/pdf/{name}',[CustomerBoughtProductController::class,'exportCustomerByProduct'])->name('export.CustomerByProduct');
        //Begin: Export files for the Type of Payment
        Route::get('/report/PaymentByType/pdf/{startdate}/{enddate}', [PaymentByTypeController::class, 'exportPaymentByType'])->name('export.PaymentType');
        //Begin: Export files for the list of products and their respective ratings
        Route::get('/report/ProductRatings/pdf/{sorting}/{startdate}/{enddate}',[ProductRatingController::class,'exportProductRatings'])->name('export.ProductRatings');
        //Begin: Export Files for the products and list of customers who rate that product
        Route::get('/report/ProductRatings/ProductRatingsByCustomer/pdf/{sorting}/{startdate}/{enddate}/{name}',[RatingsByCustomerController::class,'exportProductRatingsByCustomer'])->name('export.ProductRatingsByCustomer');
        //Begin Export Files for Sales Overtime
        Route::get('/report/MonthlySales/pdf', [MonthlySalesController::class, 'exportMonthlySales'])->name('export.MonthlySales');
        //Begin: Export Files for Sales by Product
        Route::get('/report/salesprod/pdf/{sorting}/{startdate}/{enddate}', [SalesByProductController::class, 'exportProductSales'])->name('export.ProductSales');
        //Begin Export Files for Sales by Brand
        Route::get('/report/BrandSales/pdf/{sorting}/{startdate}/{enddate}', [SalesByBrandController::class, 'exportBrandSales'])->name('export.BrandSales');
        //Begin: Export Files For Sales by Category
        Route::get('/report/CategorySales/pdf/{sorting}/{startdate}/{enddate}', [SalesByCategoryController::class, 'exportCategorySales'])->name('export.CategorySales');
        //Begin: Export Files for number of brand ordered
        Route::get('/report/BrandOrderVolume/pdf/{sorting}/{startdate}/{enddate}', [BrandOrderVolumeController::class, 'exportBrandVolume'])->name('export.BrandVolume');
        //Begin: Export Files for number of category ordered
        Route::get('/report/CategoryVolume/pdf/{sorting}/{startdate}/{enddate}', [CategoryVolumeController::class, 'exportCategoryVolume'])->name('export.CategoryVolume');
        //Begin: Export Files for customers total spent
        Route::get('/report/CustomerExpenditure/pdf/{sorting}/{startdate}/{enddate}',[CustomerTotalSpentController::class,'exportCustomerTotalSpent'])->name('export.CustomerTotalSpent');
        //Begin: Export files for List of genders
        Route::get('/report/gender/pdf', [GenderController::class, 'exportGenderExcel'])->name('export.Gender');
        //Begin: Export Files for Account Verification
        Route::get('/report/accountverification/pdf',[AccountVerificationController::class,'exportAccountVerification'])->name('export.AccountVerification');
        //export
        Route::get('/report/YearlySales/pdf',[YearlySalesController::class,'exportYearlySales'])->name('export.YearlySales');
        Route::middleware(['PreventBackHistory'])->group(function () {
            //Begin: Reports Table
            Route::resource('report', ReportController::class)->only(['index']);
            //Begin: Yearly Sales
            Route::get('/report/YearlySales', [YearlySalesController::class, 'YearlySales'])->name('report.YearlySales');
            //Begin: Browser Type
            Route::get('/report/browser', [BrowserTypeController::class, 'BrowserIndex'])->name('report.browser');
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
           //Begin: User Type
           Route::get('/report/UserType', [UserTypeController::class, 'UserTypeIndex'])->name('report.UserType');
           //Begin: Most Visited Page
           Route::get('/report/MostVisitedPage', [MostVisitedPageController::class, 'MostVisitedPageIndex'])->name('report.MostVisitedPageIndex');
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
           Route::get('/report/gender', [GenderController::class, 'GenderIndex'])->name('report.Gender');
           //Begin:
           Route::get('/report/ProductSales', [SalesByProductController::class, 'SalesByProductIndex'])->name('report.ProductSales');
           //Begin:
           Route::get('/report/CustomerExpenditure', [CustomerTotalSpentController::class, 'CustomersTotalSpent'])->name('report.CustomersTotalSpent');
           //Begin:
           Route::get('/report/BrandSales', [SalesByBrandController::class, 'BrandSalesIndex'])->name('report.BrandSales');
           //Begin:
           Route::get('/report/BrandOrderVolume', [BrandOrderVolumeController::class, 'BrandVolumeIndex'])->name('report.BrandVolume');
           //Begin:
           Route::get('/report/CategorySales', [SalesByCategoryController::class, 'CategorySalesIndex'])->name('report.CategorySales');
           //Begin:
           Route::get('/report/CategoryVolume', [CategoryVolumeController::class, 'CategoryVolumeIndex'])->name('report.CategoryVolume');

        });

    });
});

