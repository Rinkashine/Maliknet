@extends('admin.layout.admin')
@section('content')
@section('title', 'Report')
<div class="intro-y container">
    <div class="mt-2 rounded-md intro-y bg-gradient-to-b from-white to-slate-50">
        <div class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
        <div class="flex items-center pb-5 text-base font-medium border-b border-slate-200/60 dark:border-darkmode-400">
            Report
        </div>
        <div class="flex items-center py-5 text-base font-medium">
            System Section
        </div>
        <!-- Report Container -->
        <div class="grid grid-cols-12 gap-4">
            <!-- Browser -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.browser') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/Browser.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Browser</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Most Visited Page -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.MostVisitedPageIndex') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/MostVisitedPage.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Most Visited Page</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- User Type -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.UserType') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/UserType.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">User Type</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Gender -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.Gender') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/Gender.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Gender</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Payment By Type -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a  href="{{ Route('report.PaymentByType') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/PaymentByType.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Payment By Type</div>

                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>

            <!-- Customer's Cancelled Orders -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.CancelledOrders') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CustomerCancelledOrders.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Customer's Cancelled Orders</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base" >View Details</p>
                    </div>
                </a>
            </div>
            <!-- Cancellation Over Time -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.CancellationOverTime') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CancellationOverTime.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Cancellation Over Time</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Cancellation Reasons -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.CancellationReasons') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CancellationReasons.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Cancellation Reasons</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Rejected Orders -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.RejectedOrders') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/RejectedOrders.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Rejected Orders</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Monthly Gained Customers -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.customerPerMonth') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/MonthlyGainedCustomers.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Monthly Gained Customers</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Account Verification -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.AccountVerification') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/AccountVerification.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Account Verification</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Product Order Volume -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.ProductOrderVolume') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/QuantityOfOrdersByProduct.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Product Order Volume</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- >Customer's Order Volume -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a href="{{ Route('report.CustomerOrderVolume') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/QuantityOfOrdersByCustomer.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 text-center sm:text-sm sm:text-left">Customer's Order Volume</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
            <!-- Product Ratings -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a class="sm:text-base" href="{{ Route('report.ProductRatings') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/ProductRating.svg') }}">
                    </div>
                    <div>
                        <div class="mb-5 ml-1 sm:mb-0 sm:text-sm">Product Ratings</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p class="sm:text-base">View Details</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="flex items-center py-5 mt-8 text-base font-medium border-t">
            Sales Section
        </div>
        <div class="grid grid-cols-12 gap-4">

            <!-- Monthly Sales -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/MonthlySales.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Monthly Sales</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.MonthlySales') }}">View Details</a>
                </div>
            </div>
            <!-- Product Sales -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/ProductSales.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Product Sales</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.ProductSales') }}">View Details</a>
                </div>
            </div>
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <a class="sm:text-base" href="{{ Route('report.YearlySales') }}">
                    <div>
                        <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/YearlySales.svg') }}">
                    </div>
                    <div>
                        <div class="ml-1 sm:text-sm">Yearly Sales</div>
                    </div>
                    <div class="p-1 mt-1 text-sm text-center border-t">
                        <p>View Details</p>
                    </div>
                </a>
            </div>
            <!-- Customer Expenditure -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CustomerExpenditure.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Customer Expenditure</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.CustomersTotalSpent') }}">View Details</a>
                </div>
            </div>
            <!-- Brand Sales  -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/BrandSales.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Brand Sales</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.BrandSales') }}">View Details</a>
                </div>
            </div>
            <!-- Category Sales -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CategorySales.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Category Sales</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.CategorySales') }}">View Details</a>
                </div>
            </div>


            <!-- Brand Order Volume -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/BrandOrderVolume.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Brand Order Volume</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.BrandVolume') }}">View Details</a>
                </div>
            </div>
            <!-- Category Order Volume -->
            <div class="col-span-6 p-2 text-xs bg-white border rounded-md shadow-md md:col-span-3 lg:col-span-2 w-fit zoom-in">
                <div>
                    <img class="object-scale-down w-full max-w-md max-h-56" src="{{ asset('dist/images/CategoryOrderVolume.svg') }}">
                </div>
                <div>
                    <div class="ml-1 sm:text-sm">Category Order Volume</div>
                </div>
                <div class="p-1 mt-1 text-sm text-center border-t">
                    <a class="sm:text-base" href="{{ Route('report.CategoryVolume') }}">View Details</a>
                </div>
            </div>
        </div>
            <!-- End: Reports Table -->
        </div>
    </div>
</div>

@endsection
