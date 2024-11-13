<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{ Route('report.index') }}" class="mr-2 bg-white btn">←</a>Customer Gender Demographics
        </h2>
        @can('report_export')
            <a href="{{ Route('export.Gender') }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Main Body Chart -->
        <div class="hidden col-span-12 sm:mt-5 xl:col-span-8 sm:block">
            <div class="w-full mt-5 box">
                <div class="p-5" >
                    <div class="flex items-center justify-center ">
                        <div class="w-1/2 h-1/2" wire:ignore>
                            <canvas id="Gender"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END: Main Body Chart -->
        <!-- BEGIN: Table Data -->
        <div class="col-span-12 xl:col-span-4 2xl:mt-5">
            <div class="p-2 mt-5 intro-y box">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        Data
                    </h2>
                </div>
                <div class="sm:p-3">
                    <div class="border">
                        <table class="table text-xs table-fixed">
                            <thead class="bg-primary">
                                <tr class="text-white sm:text-base">
                                    <td class="text-center whitespace-nowrap">Gender</td>
                                    <td class="text-center whitespace-nowrap">Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gender as $data)
                                    <tr class="sm:text-sm">
                                        <td class="text-center whitespace-nowrap">{{ $data->gender}}</td>
                                        <td class="text-center whitespace-nowrap">{{ $data->total }}</td>
                                    </tr>
                                @empty
                                    <tr lass="sm:text-sm">
                                        <td class="text-center whitespace-nowrap" colspan="3">No Data Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Table Data -->
    </div>

    @push('scripts')
    <script>
        var genderlabel = {{ Js::from($genderlabel) }};
        var genderdataset =  {{ Js::from($genderdataset) }};
        const data = {
            labels: genderlabel,
            datasets: [{
                label: 'Gender',
                data: genderdataset,
                backgroundColor: [
                'rgb(30,95,78)',
                'rgb(250,209,44)',
                'rgb(246,168,35)'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
        };

        const GenderChart = new Chart(
            document.getElementById('Gender'),
            config
        );

    </script>
    @endpush
</div>
