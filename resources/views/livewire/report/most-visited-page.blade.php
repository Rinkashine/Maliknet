<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <div class="text-base">
            <h2 class="mr-auto font-medium sm:text-lg">
                <a href="{{ Route('report.index') }}" class="mr-2 text-lg bg-white btn">←</a>Most Visited Page Report
            </h2>
        </div>
        @can('report_export')
            <a href="{{ Route('export.MostVisitedPage',['startdate'=>$startdate,'enddate'=>$enddate]) }}" class="btn btn-primary">
                Export
            </a>
        @endcan
    </div>

    <!-- Charts -->
    <div class="hidden sm:mt-10 intro-y box sm:block ">
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
        <div class="p-5" wire:ignore>
            <canvas id="visitedpagechart" height="80px"></canvas>
        </div>
    </div>

        <div class="p-2 mt-5 intro-y box">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Page Ranking
                </h2>
            </div>

            <div class="block mt-3 sm:p-3 sm:hidden">
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


            <div class="mt-3 sm:p-3">
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <td class="text-center whitespace-nowrap">Rank</td>
                                <td class="text-center whitespace-nowrap">Page</td>
                                <td class="text-center whitespace-nowrap">Views</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mostvisitedpage as $page)
                            <tr class="sm:text-sm">
                                <td class="text-center whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="text-center whitespace-nowrap"><a href="{{ $page['url']}}">{{ $page['pageTitle'] }}</a></td>
                                <td class="text-center whitespace-nowrap">{{ $page['pageViews'] }}</td>
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

    @push('scripts')
    <script>
        var mostvisitedlabel = {{ Js::from($mostvisitedlabel) }};
        var mostvisiteddataset =  {{ Js::from($mostvisiteddataset) }};
        let randomBackgroundColor = [];
        let usedColors = new Set();

        let dynamicColors = function() {
            let r = Math.floor(Math.random() * 255);
            let g = Math.floor(Math.random() * 255);
            let b = Math.floor(Math.random() * 255);
            let color = "rgb(" + r + "," + g + "," + b + ")";

            if (!usedColors.has(color)) {
                usedColors.add(color);
                return color;
            } else {
                return dynamicColors();
            }
        };

        for (let i in mostvisitedlabel) {
            randomBackgroundColor.push(dynamicColors());
        }
        const data = {
        labels: mostvisitedlabel,
            datasets: [{
                label: 'Page Views',
                data: mostvisiteddataset,
                backgroundColor: randomBackgroundColor,
                borderColor: randomBackgroundColor,
                borderWidth: 1
            }]
        };

        const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        //init block
        let visitedpagechart = new Chart(
            document.getElementById('visitedpagechart'), config
        );

        window.addEventListener('render-chart',event => {
            visitedpagechart.config.data.labels = event.detail.label;
            visitedpagechart.config.data.datasets[0].data = event.detail.dataset;
            visitedpagechart.update()
        });

    </script>

    @endpush


</div>
