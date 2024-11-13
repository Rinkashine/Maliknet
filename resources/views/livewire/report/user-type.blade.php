<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index') }}" class="mr-2 bg-white btn">←</a>User Type
        </h2>
        @can('report_export')
            <a href="{{Route('export.UserType',['startdate'=>$startdate,'enddate'=>$enddate]) }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Most Visited Page -->
        <div class="hidden col-span-12 sm:mt-5 sm:block xl:col-span-8">
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
                                <input type="datetime-local" wire:model="enddate" class="form-control" min="{{ $startdate }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-5" >
                    <div class="flex items-center justify-center ">
                        <div class="w-1/2 h-1/2" wire:ignore>
                            <canvas id="UserType"  ></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Official Store -->
        <!-- BEGIN: Weekly Best Sellers -->
        <div class="col-span-12 xl:col-span-4 2xl:mt-5">
            <div class="mt-5 intro-y box">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        User Type Data
                    </h2>
                </div>

                <div class="block p-2 mt-3 sm:hidden" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">From:</label>
                        <input type="datetime-local" wire:model.lazy="startdate" class="form-control" max="{{ $enddate }}">
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">To:</label>
                        <input type="datetime-local" wire:model="enddate" class="form-control" min="{{ $startdate }}">
                    </div>
                </div>

                <div class="p-2 mt-3">
                    <div class="sm:p-3">
                        <div class="border">
                            <table class="table text-xs table-fixed">
                                <thead class="bg-primary">
                                    <tr class="text-white sm:text-base">
                                        <td class="text-center whitespace-nowrap">Rank</td>
                                        <td class="text-center whitespace-nowrap">Type</td>
                                        <td class="text-center whitespace-nowrap">Sessions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($usertype as $user)
                                        <tr class="sm:text-sm">
                                            <td class="text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                                            <td class="text-center whitespace-nowrap">{{ $user['type'] }}</td>
                                            <td class="text-center whitespace-nowrap">{{ $user['sessions'] }}</td>
                                        </tr>
                                    @empty
                                        <tr class="sm:text-sm">
                                            <td class="text-center whitespace-nowrap" colspan="3">No Data Found</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Weekly Best Sellers -->
    </div>

    @push('scripts')
<script>

    //Begin: User Type Chart
    var usertypelabel =  {{ Js::from($usertypelabel) }};
    var usertypedataset =  {{ Js::from($usertypedataset) }};
    const usertypedata = {
    labels: usertypelabel,
    datasets: [{
        label: 'User Type',
        data: usertypedataset,
        backgroundColor: [
        'rgb(30,95,78)',
        'rgb(250,209,44)',
        ],
        hoverOffset: 4
    }]
    };
    const usertypeconfig = {
        type: 'pie',
        data: usertypedata,
    };

    const UserTypeChart = new Chart(
        document.getElementById('UserType'),
        usertypeconfig
    );

    window.addEventListener('render-chart',event => {
        UserTypeChart.config.data.labels = event.detail.label;
        UserTypeChart.config.data.datasets[0].data = event.detail.dataset;
        UserTypeChart.update()
        });
    //End: User Type Chart

    </script>

@endpush

</div>
