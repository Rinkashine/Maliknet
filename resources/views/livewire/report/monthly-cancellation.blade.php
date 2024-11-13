<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 text-sm intro-y">
            <h2 class="mr-auto font-medium sm:text-lg">
                <a href="{{ Route('report.CancellationOverTime') }}" class="mr-2 text-lg bg-white btn">←</a>{{$date}} Cancellations
            </h2>
        @can('report_export')
                <a href="{{ Route('export.MonthlyCancellation', ['month'=> $month, 'year' => $year, 'startdate'=> $from,'enddate'=> $to]) }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="box">
        <!-- Begin: Table Mobile -->
        <div class="block mt-5 sm:hidden intro-y">
            @foreach ($cancellations as $cancellation)
                <div class="grid grid-cols-7 mt-2 text-xs border rounded-lg">
                    <div class="col-span-3 p-2 rounded-l-lg bg-primary">
                        <div class="grid gap-1 text-center text-white">
                            <div>Order ID</div>
                            <div>Customer Name</div>
                            <div>Cancellation Reasons</div>
                        </div>
                    </div>
                    <div class="col-span-4 p-2">
                        <div class="grid gap-1">
                            <div><a href="{{ Route('orders.show',$cancellation->id) }}">{{ $cancellation->id }}</a></div>
                            <div>{{ $cancellation->customer_name }}</div>
                            <div>{{ $cancellation->reason_name }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End: Table Mobile -->

        <div class="hidden mt-5 sm:mt-10 box intro-y sm:block">
            <div class="p-3">
                <div class="border">
                    <table class="table table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-base text-white">
                                <td class="text-center whitespace-nowrap">Order ID</td>
                                <td class="text-center whitespace-nowrap">Customer Name</td>
                                <td class="text-center whitespace-nowrap">Cancellation Reason</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancellations as $cancellation)
                            <tr class="text-sm">
                                <td class="text-center wwhitespace-nowrap"> <a href="{{ Route('orders.show',$cancellation->id) }}">{{ $cancellation->id }}</a></td>
                                <td class="text-center whitespace-nowrap">{{ $cancellation->customer_name }}</td>
                                <td class="text-center whitespace-nowrap">{{ $cancellation->reason_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
