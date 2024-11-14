@extends('admin.layout.admin')
@section('content')
@section('title', 'Dashboard')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">₱{{ number_format($totalsales,2) }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="monitor" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ number_format($productCount) }}</div>
                                <div class="text-base text-slate-500 mt-1">Product Count</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $completedorderscount }}</div>
                                <div class="text-base text-slate-500 mt-1">Completed Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="more-horizontal" class="report-box__icon text-primary"></i>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $pendingorderscount }}</div>
                                <div class="text-base text-slate-500 mt-1">Pending Orders</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 xl:col-span-8 mt-4 hidden sm:block">
                <div class=" w-full">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-lg mr-auto">
                            Sales For The Past 12 Months
                        </h2>
                    </div>
                    <div class="p-5 mt-5 box">
                        <canvas id="test" height="140px"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <div class="col-span-12 xl:col-span-4 mt-4">
                <div class="w-full">
                    <h2 class="text-lg font-medium border-b border-slate-200/60 dark:border-darkmode-400">
                        Top 3 Customers
                    </h2>
                </div>
                <div class="mt-5">
                    @foreach ( $topCustomers  as $customers)
                        <div class="intro-y">
                            <a href="{{ Route('customer.show',$customers) }}">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{$customers->name}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{$customers->email}}</div>
                                    </div>
                                    <div class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium">₱{{ number_format($customers->total_spent,2) }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @can('report_access')
                        <a href="{{ Route('report.CustomersTotalSpent') }}" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</a>
                    @endcan
                </div>
            </div>

        </div>
    </div>
    <div class="col-span-12 2xl:col-span-3">
        <div class="2xl:border-l -mb-10 pb-10">
            <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                <!-- BEGIN: Transactions -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Top Selling Products
                        </h2>
                    </div>
                    <div class="mt-5">
                        @foreach ($topSellingProducts as $product)
                            <div class="intro-x">
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{$product->product_name}}</div>
                                    </div>
                                    <div class="text-success">{{$product->quantity}}</div>
                                </div>
                            </div>
                        @endforeach
                        @can('report_access')
                            <a href="{{ Route('report.ProductSales') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</a>
                        @endcan
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Top Rated Products
                        </h2>
                    </div>
                    <div class="mt-5">
                        @foreach ($ratedProducts as $product)
                            <div class="intro-x">
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{$product->name}}</div>
                                    </div>
                                    <div class="text-success">{{number_format($product->ave,2)}}</div>
                                </div>
                            </div>
                        @endforeach
                        @can('report_access')
                            <a href="{{ Route('report.ProductRatings') }}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</a>
                        @endcan
                    </div>
                </div>
                <!-- END: Transactions -->
                <!-- BEGIN: Recent Activities -->
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-4 2xl:mt-3">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Most Visited Page
                        </h2>
                    </div>
                    <div class="mt-5">

                    </div>
                </div>
                <!-- END: Recent Activities -->
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>

        var saleschartlabel = {{ Js::from($saleschartlabel) }}
        var saleschartdataset = {{ Js::from($saleschartdataset) }}
        const labels = saleschartlabel;
        const data = {
        labels: labels,
        datasets: [{
            label: 'Sales',
            data: saleschartdataset,
            fill: false,
            borderColor: 'rgb(30,95,78)',
            tension: 0.1
        }]
        };

        const config = {
            type: 'line',
            data: data,
        };

        const Sales = new Chart(
            document.getElementById('test'),
            config
        );
        //End: Sales Chart

    </script>
@endpush


