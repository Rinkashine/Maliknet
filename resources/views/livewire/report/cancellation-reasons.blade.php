<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-base font-medium">
            <a href="{{Route('report.index')}}" class="mr-2 text-lg bg-white btn">←</a>Cancelled Reasons Report
        </h2>
        @can('report_export')
            <a href="{{Route('export.CancellationReason',['sorting'=>$sorting,'startdate'=>$from,'enddate'=>$to])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="hidden w-full mt-5 sm:mt-10 box sm:block">
        <div class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
            <div class="flex items-center justify-between pb-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <div class="text-base font-medium">
                    Cancelled Reasons Chart
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-1/2" wire:ignore >
                    <canvas id="ReasonForCancellationChart"  ></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 intro-y box">
        <div class="p-2 border rounded-md border-slate-200/60 dark:border-darkmode-400">

            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
                <div class="mt-5 xl:flex sm:mr-auto" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                        <select wire:model="sorting"  class="w-full mt-2 form-select 2xl:w-full sm:mt-0 sm:w-auto">
                            <option value="cancellation_name_asc">Cancellation Name (A-Z)</option>
                            <option value="cancellation_name_desc">Cancellation Name (Z-A)</option>
                            <option value="total_spent_asc">Total Cancellations (Low To High)</option>
                            <option value="total_spent_desc">Total Cancellations (High To Low)</option>
                        </select>
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">From:</label>
                        <input class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" wire:model="from" id="from" name ="from"  type="datetime-local" max="{{ $to }}" />
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">To:</label>
                        <input type="datetime-local" class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" id="to" name ="to" wire:model="to" min="{{ $from }}"/>
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">Search</label>
                        <input wire:model.lazy="search" type="search" class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" placeholder="Search...">
                    </div>
                </div>
            </div>
            <!-- Begin: Table Desktop-->
            <div class="mt-3 sm:mt-0 sm:p-3 intro-y" >
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="whitespace-nowrap ">Cancellation Reason</th>
                                <th class="text-center whitespace-nowrap">Total Cancellations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cancellations as $cancellation )
                                <tr class="sm:text-sm">
                                    <td class="whitespace-nowrap ">{{$cancellation->name}}</td>
                                    <td class="text-center whitespace-nowrap">{{$cancellation->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Brand Table -->
            <div class="flex flex-wrap items-center col-span-12 mt-5 sm:p-3 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $cancellations->onEachSide(1)->links() !!}
                </nav>
                <div class="mx-auto text-slate-500">
                    @if($cancellations->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$cancellations->firstItem()}} to {{$cancellations->lastItem()}} of {{$cancellations->total()}} entries
                    @endif
                </div>
                <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
    </div>

    @push('scripts')
         <script>
            //Begin: User Type Chart+
            var label =  {{ Js::from($cancelled_reason_label) }};
            var reasondataset =  {{ Js::from($cancelled_reason_dataset) }};

            const data = {
                labels: label,
                datasets: [{
                    label: 'Dataset',
                    data: reasondataset,
                    backgroundColor: [
                        'rgb(30,95,78)',
                        'rgb(250,209,44)',
                        'rgba(255, 99, 132)',
                        'rgba(255, 159, 64)',
                        'rgba(255, 205, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(54, 162, 235)',
                        'rgba(153, 102, 255)',
                        'rgba(201, 203, 207)'
                    ],
                    hoverOffset: 4
                }]
            };

            const config = {
                type: 'pie',
                data: data,
            };


            const CancelledChart = new Chart(
                document.getElementById('ReasonForCancellationChart'),
                config
            );

            window.addEventListener('render-chart',event => {
                CancelledChart.config.data.labels = event.detail.label;

                CancelledChart.config.data.datasets[0].data = event.detail.reasons;

                CancelledChart.update();
            });

            //End: User Type Chart

         </script>
    @endpush
</div>

