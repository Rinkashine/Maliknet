<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index')}}" class="mr-2 bg-white btn">←</a> Brand Order Volume
        </h2>
        @can('report_export')
            <a href="{{Route('export.BrandVolume',['sorting'=>$sorting,'startdate'=>$from,'enddate'=>$to])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="w-full p-5 mt-10 box sm:block hidden intro-y">
        <div class="p-5">
            <div class="flex items-center justify-between pb-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <div class="text-base font-medium">
                    Quantity Orders Chart
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-full" wire:ignore>
                    <canvas id="SalesOrderChart"  ></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:mt-10 intro-y box">
        <div class="p-2 mt-5">

            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
                <div class="mt-5 xl:flex sm:mr-auto" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                        <select wire:model="sorting"  class="w-full mt-2 form-select 2xl:w-full sm:mt-0 sm:w-auto">
                            <option value="brand_name_asc">Brand Name (A-Z)</option>
                            <option value="brand_name_desc">Brand Name (Z-A)</option>
                            <option value="order_quantity_asc">Order Quantity (Low To High)</option>
                            <option value="order_quantity_desc">Order Quantity (High To Low)</option>
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
            <!-- Begin: Brand Table -->
            <div class="sm:p-3 mt-3 sm:mt-0 intro-y" >
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="whitespace-nowrap ">Brand Name</th>
                                <th class="text-center whitespace-nowrap">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand )
                                <tr class="sm:text-sm">
                                    <td class="whitespace-nowrap ">{{$brand->name}}</td>
                                    <td class="text-center whitespace-nowrap">{{number_format($brand->order_quantity)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Brand Table -->
            <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $brands->onEachSide(1)->links() !!}
                </nav>
                <div class="mx-auto text-slate-500">
                    @if($brands->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$brands->firstItem()}} to {{$brands->lastItem()}} of {{$brands->total()}} entries
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
            var label =  {{ Js::from($brandlabel) }};

            var salesorderdataset =  {{ Js::from($brandordersdataset) }};
            const ordertypedata = {
            labels: label,
            datasets: [{
                label: 'Orders',
                data: salesorderdataset,
                backgroundColor: [
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
            const ordertypeconfig = {
                type: 'bar',
                data: ordertypedata,
                options: {
                    scales: {
                    y: {
                        beginAtZero: true
                        }
                    }
                },
            };

            const SalesOrderChart = new Chart(
                document.getElementById('SalesOrderChart'),
                ordertypeconfig
            );

            window.addEventListener('render-chart',event => {
                SalesOrderChart.config.data.labels = event.detail.label;

                SalesOrderChart.config.data.datasets[0].data = event.detail.orderdataset;

                SalesOrderChart.update();
                });

            //End: User Type Chart

         </script>
     @endpush
</div>

