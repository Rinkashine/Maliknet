<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-base font-medium truncate">
            <a href="{{Route('report.ProductRatings')}}" class="mr-2 text-lg bg-white btn">←</a> {{$product_name}} Ratings Report
        </h2>
        @can('report_export')
            <a href="{{Route('export.ProductRatingsByCustomer', ['sorting'=>$sorting,'startdate'=>$from,'enddate'=>$to, 'name' => $product_name, 'product_id' => $product_id])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="mt-5 sm:mt-10 intro-y box">
        <div class="p-2">
            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
                <div class="mt-5 xl:flex sm:mr-auto" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                        <select wire:model="sorting"  class="w-full mt-2 form-select sm:w-32 2xl:w-full sm:mt-0 sm:w-auto">
                            <option value="customer_name_asc">Customer Name (A-Z)</option>
                            <option value="customer_name_desc">Customer Name (Z-A)</option>
                            <option value="recent">Most Recent</option>
                            <option value="total_rating_asc">Rating(Low To High)</option>
                            <option value="total_rating_desc">Rating (High To Low)</option>
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
                        <input wire:model.lazy="search" type="search" class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" placeholder="Search customer name...">
                    </div>
                </div>
            </div>
            <!-- Begin: Table Mobile -->
            <div class="block sm:hidden intro-y">
                @foreach ($rating as $rate )
                    <div class="grid grid-cols-7 mt-2 text-xs border rounded-lg">
                        <div class="col-span-3 p-2 rounded-l-lg bg-primary">
                            <div class="grid gap-1 text-center text-white">
                                <div>Order ID</div>
                                <div>Customer Name</div>
                                <div>Rate</div>
                            </div>
                        </div>
                        <div class="col-span-4 p-2">
                            <div class="grid gap-1">
                                <div><a href="{{ Route('orders.show',$rate->customer_order_id) }}">#{{ ($rate->customer_order_id)}}</a></div>
                                <div><a href="{{ Route('customer.show',$rate->customer_id) }}">{{ $rate->name}}</a></div>
                                <div>{{ $rate->rate}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->
            <!-- Begin: rates Table -->
            <div class="hidden p-3 sm:block">
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="text-center whitespace-nowrap">Order ID</th>
                                <th class="text-center whitespace-nowrap">Customer name</th>
                                <th class="text-center whitespace-nowrap">Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rating as $rate )
                                <tr class="sm:text-sm">
                                    <td class="text-center whitespace-nowrap"><a href="{{ Route('orders.show',$rate->customer_order_id) }}">#{{ ($rate->customer_order_id)}}</a></td>
                                    <td class="text-center whitespace-nowrap"><a href="{{ Route('customer.show',$rate->customer_id) }}">{{ $rate->name}}</a></td>
                                    <td class="text-center whitespace-nowrap">{{ $rate->rate}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: rates Table -->
            <!-- Begin: rates Pagination -->
            <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $rating->onEachSide(1)->links() !!}
                </nav>
                <div class="mx-auto text-slate-500">
                    @if($rating->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$rating->firstItem()}} to {{$rating->lastItem()}} of {{$rating->total()}} entries
                    @endif
                </div>
                <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            <!-- End: rates Pagination -->
        </div>
    </div>
</div>

