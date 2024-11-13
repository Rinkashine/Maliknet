<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{ Route('report.index') }}" class="mr-2 bg-white btn">←</a>Cancellations Over Time
        </h2>
        @can('report_export')
            <a href="{{ Route('export.CancellationOverTime') }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="mt-5 sm:mt-10 intro-y box ">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="mr-auto text-base font-medium">
                Cancellation Total
            </h2>
        </div>

        <div class="p-2">
        <!-- Begin: Table Mobile -->
        <div class="block sm:hidden intro-y">
            @foreach ($monthlycancellations as $cancellations)
                <div class="grid grid-cols-5 mt-2 text-xs border rounded-lg">
                    <div class="col-span-2 p-2 rounded-l-lg bg-primary">
                        <div class="grid gap-1 text-center text-white">
                            <div>Year</div>
                            <div>Month</div>
                            <div>Total Cancellations</div>
                            <div></div>
                        </div>
                    </div>
                    <div class="col-span-3 p-2">
                        <div class="grid gap-1">
                            <div>{{ $cancellations->year }}</div>
                            <div>{{ $cancellations->month_name }}</div>
                            <div class="border-b">{{ number_format($cancellations->total) }}</div>
                            <div class="text-center"><a href="{{ Route('report.MonthlyCancellation', ['month'=>$cancellations->month_name, 'year' =>$cancellations->year]) }}">View Details</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End: Table Mobile -->

            <div class="hidden sm:p-3 sm:block">
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <td class="text-center whitespace-nowrap">Year</td>
                                <td class="text-center whitespace-nowrap">Month</td>
                                <td class="text-center whitespace-nowrap">Total Cancellations</td>
                                <td class="text-center whitespace-nowrap"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monthlycancellations as $cancellations)
                                <tr class="sm:text-sm">
                                    <td class="text-center wwhitespace-nowrap">{{ $cancellations->year }}</td>
                                    <td class="text-center whitespace-nowrap">{{ $cancellations->month_name }}</td>
                                    <td class="text-center whitespace-nowrap">{{ number_format($cancellations->total) }}</td>
                                    <td class="text-center whitespace-nowrap"><a href="{{ Route('report.MonthlyCancellation', ['month'=>$cancellations->month_name, 'year' =>$cancellations->year]) }}">View Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
