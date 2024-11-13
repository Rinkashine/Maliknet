<div>
    <div class="intro-y flex justify-between items-center mt-5">
            <h2 class="text-lg font-medium mr-auto">
                <a href="{{ Route('report.index') }}" class="mr-2 bg-white btn">←</a>Monthly Sales
            </h2>
        @can('report_export')
                <a href="{{ Route('export.MonthlySales') }}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="intro-y box mt-5 sm:mt-10 sm:block hidden">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <div>
                <div>
                    <h2 class="font-medium text-base mr-auto">
                        Sales Chart
                    </h2>
                </div>
            </div>
        </div>
        <div class="p-5" wire:ignore>
            <canvas id="test" height="80px"></canvas>
        </div>
    </div>

    <div class="intro-y p-2 box mt-5 ">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Monthly Sales
            </h2>
        </div>

        <div class="sm:p-3">
            <div class="border">
                <table class="table table-fixed text-xs">
                    <thead class="bg-primary">
                        <tr class="text-white sm:text-base">
                            <td class="whitespace-nowrap text-center">Year</td>
                            <td class="whitespace-nowrap text-center">Month</td>
                            <td class="whitespace-nowrap text-center">Sales</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlysales as $sales)
                        <tr class="sm:text-sm">
                            <td class="wwhitespace-nowrap text-center">{{ $sales->year }}</td>
                            <td class="whitespace-nowrap text-center">{{ $sales->month_name }}</td>
                            <td class="whitespace-nowrap text-center">₱{{ number_format($sales->total) }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

            var saleschartlabel = {{ Js::from($saleschartlabel) }}
            var saleschartdataset = {{ Js::from($saleschartdataset) }}

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

            for (let i in saleschartlabel) {
                randomBackgroundColor.push(dynamicColors());
            }

            const data = {
            labels: saleschartlabel,
            datasets: [{
                label: 'Sales',
                data: saleschartdataset,
                backgroundColor: randomBackgroundColor,
                borderColor: randomBackgroundColor,
                borderWidth: 1
            }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    plugins: {
                        legend: false // Hide legend
                    },
                },
            };

            const Sales = new Chart(
                document.getElementById('test'),
                config
            );
            //End: Sales Chart
            document.querySelector("input[type=number]")
            .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
        </script>
    @endpush
</div>
