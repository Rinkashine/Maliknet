<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
            <h2 class="mr-auto text-base font-medium">
                <a href="{{Route('report.index')}}" class="mr-2 text-lg bg-white btn">←</a>Monthly Gained Customer
            </h2>
        @can('report_export')
            <a href="{{ Route('export.MonthlyGainedCustomers') }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="sm:mt-10 intro-y box ">
        <div class="flex items-center p-5 mt-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="mr-auto text-base font-medium">
                Gained Customers
            </h2>
        </div>

        <div class="p-2">
            <!-- Begin: Table Mobile -->
            <div class="block p-3 sm:hidden intro-y">
                @foreach ($monthlysales as $sales)
                    <div class="grid grid-cols-9 mt-2 text-xs border rounded-lg">
                        <div class="col-span-4 p-2 rounded-l-lg bg-primary">
                            <div class="grid gap-1 text-center text-white">
                                <div>Year</div>
                                <div>Month</div>
                                <div>Created Accounts</div>
                            </div>
                        </div>
                        <div class="col-span-5 p-2">
                            <div class="grid gap-1">
                                <div>{{$sales->year}}</div>
                                <div>{{$sales->month_name}}</div>
                                <div class="border-b">{{number_format($sales->total)}}</div>
                                <div class="text-center"><a href="{{ Route('report.ShowCustomerPerMonth', ['month'=>$sales->month_name, 'year' =>$sales->year]) }}">View Details</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->

            <div class="hidden mt-3 sm:p-3 sm:block">
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <td class="text-center whitespace-nowrap">Year</td>
                                <td class="text-center whitespace-nowrap">Month</td>
                                <td class="text-center whitespace-nowrap">Created Accounts</td>
                                <td class="text-center whitespace-nowrap"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthlysales as $sales)
                            <tr class="sm:text-sm">
                                <td class="text-center wwhitespace-nowrap">{{ $sales->year }}</td>
                                <td class="text-center whitespace-nowrap">{{ $sales->month_name }}</td>
                                <td class="text-center whitespace-nowrap">{{ number_format($sales->total) }}</td>
                                <td class="text-center whitespace-nowrap"><a href="{{ Route('report.ShowCustomerPerMonth', ['month'=>$sales->month_name, 'year' =>$sales->year]) }}">View Details</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
