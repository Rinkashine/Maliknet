<div>
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{ Route('report.index') }}" class="mr-2 bg-white btn">←</a>Payment By Type
        </h2>
        @can('report_export')
            <a href="{{Route('export.PaymentType',['startdate'=>$startdate,'enddate'=>$enddate])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="grid grid-cols-12 gap-6">

        <!-- BEGIN: Payment Type Chart -->
        <div class="hidden col-span-12 sm:mt-5 xl:col-span-8 sm:block">
            <div class="w-full mt-5 box">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <div class="flex flex-col sm:flex-row sm:items-end xl:items-start ">
                        <div class="xl:flex sm:mr-auto" >
                            <div class="items-center sm:flex sm:mr-4">
                                <label class="flex-none mr-2 xl:w-auto xl:flex-initial">From:</label>
                                <input type="datetime-local" wire:model.lazy="startdate" class="form-control" max="{{ $enddate }}">
                            </div>
                            <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                                <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">To:</label>
                                <input type="datetime-local" wire:model.lazy="enddate" class="form-control" min="{{ $startdate }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-5" >
                    <div class="flex items-center justify-center ">
                        <div class="w-1/2 h-1/2" wire:ignore>
                            <canvas id="PaymentType"  ></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Payment Type Chart -->

        <!-- BEGIN: Payment Type Table -->
        <div class="col-span-12 xl:col-span-4 2xl:mt-5">
            <div class="p-2 mt-5 intro-y box">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        Types of Payment
                    </h2>
                </div>

                <div class="block mt-3 sm:p-3 sm:hidden">
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">From:</label>
                        <input type="datetime-local" wire:model.lazy="startdate" class="form-control" max="{{ $enddate }}">
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">To:</label>
                        <input type="datetime-local" wire:model.lazy="enddate" class="form-control" min="{{ $startdate }}">
                    </div>
                </div>

                <div class="mt-3 sm:p-3">
                    <div class="border">
                        <table class="table text-sm table-fixed">
                            <thead class="bg-primary">
                                <tr class="text-white sm:text-base">
                                    <td class="text-center whitespace-nowrap">Mode of Payment</td>
                                    <td class="text-center whitespace-nowrap">Sessions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($typeofpayment as $data)
                                    <tr class="sm:text-base">
                                        <td class="text-center whitespace-nowrap">{{ $data->type }}</td>
                                        <td class="text-center whitespace-nowrap">{{ number_format($data->total) }}</td>
                                    </tr>
                                @empty
                                    <tr class="sm:text-base">
                                        <td class="text-center whitespace-nowrap" colspan="2">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Payment Type Table -->
    </div>

    @push('scripts')
        <script>
            //Begin: Payment Type Pie Chart
            var paymenttypelabel =  {{ Js::from($paymenttypelabel) }};
            var paymenttypedataset =  {{ Js::from($paymenttypedataset) }};
            const paymenttypedata = {
            labels: paymenttypelabel,
            datasets: [{
                label: 'dataset',
                data: paymenttypedataset,
                backgroundColor: [
                'rgb(30,95,78)',
                'rgb(250,209,44)',
                ],
                hoverOffset: 4
            }]
            };
            const paymenttypeconfig = {
                type: 'pie',
                data: paymenttypedata,
            };

            const PaymentTypeChart = new Chart(
                document.getElementById('PaymentType'),
                paymenttypeconfig
            );
            window.addEventListener('render-chart',event => {
                PaymentTypeChart.config.data.labels = event.detail.label;
                PaymentTypeChart.config.data.datasets[0].data = event.detail.dataset;
                PaymentTypeChart.update()
            });
            //End: Payment Type Pie Chart
        </script>
    @endpush

</div>
