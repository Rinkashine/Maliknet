<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index') }}" class="mr-2 bg-white btn">←</a>Account Verification
        </h2>
        @can('report_export')
            <a href="{{Route('export.AccountVerification') }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Main Body Chart -->
        <div class="hidden col-span-12 sm:mt-5 intro-y xl:col-span-8 sm:block">
            <div class="w-full mt-5 box">
                <div class="p-5" >
                    <div class="flex items-center justify-center ">
                        <div class="w-1/2 h-1/2" wire:ignore>
                            <canvas id="Account"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Main Body Chart -->

        <!-- BEGIN: Table Data -->
        <div class="col-span-12 sm:mt-5 xl:col-span-4">
            <div class="mt-5 intro-y box">
                <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        Verified User Report
                    </h2>
                </div>
                <div class="p-2">
                    <div class="sm:p-3">
                        <div class="border">
                            <table class="table text-xs table-fixed">
                                <thead class="bg-primary">
                                    <tr class="text-white sm:text-base">
                                        <td class="whitespace-nowrap">Type</td>
                                        <td class="text-center whitespace-nowrap">Total</td>
                                        <td class="text-center whitespace-nowrap">Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="sm:text-sm">
                                        <td class="whitespace-nowrap">Verified</td>
                                        <td class="text-center whitespace-nowrap">{{$verified}}</td>
                                        <td class="text-center whitespace-nowrap"><a href="{{ Route('report.VerifiedAccount') }}">View Details</a></td>
                                    </tr>
                                    <tr class="sm:text-sm">
                                        <td class="whitespace-nowrap">Non-Verified</td>
                                        <td class="text-center whitespace-nowrap">{{$nonverified}} </td>
                                        <td class="text-center whitespace-nowrap"><a href="{{ Route('report.NonVerifiedAccount') }}">View Details</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Table Data -->
    </div>
    @push('scripts')
        <script>
            var accountlabel = {{ Js::from($accountlabel) }};
            var accountdataset =  {{ Js::from($accountdataset) }};
            const data = {
                labels: accountlabel,
                datasets: [{
                    label: 'User Types',
                    data: accountdataset,
                    backgroundColor: [
                    'rgb(30,95,78)',
                    'rgb(250,209,44)',
                    ],
                    hoverOffset: 4
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
            };

            const GenderChart = new Chart(
                document.getElementById('Account'),
                config
            );

        </script>
    @endpush
</div>
