<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index')}}" class="mr-2 bg-white btn">←</a> Product Ratings Report
        </h2>
        @can('report_export')
            <a href="{{ Route('export.ProductRatings', [
                'sorting' => $sorting,
                'startdate' => $from ?? '',
                'enddate' => $to ?? ''
            ]) }}" class="btn btn-primary">Export</a>
        @endcan

    </div>

    <div class="mt-5 sm:mt-10 intro-y box">
        <div class="p-2">
            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
                <div class="mt-5 xl:flex sm:mr-auto" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                        <select wire:model="sorting"  class="w-full mt-2 form-select 2xl:w-full sm:mt-0 sm:w-auto">
                            <option value="product_name_asc">Product Name (A-Z)</option>
                            <option value="product_name_desc">Product Name (Z-A)</option>
                            <option value="total_number_asc">Number of Review(Low To High)</option>
                            <option value="total_number_desc">Number of Review (High To Low)</option>
                            <option value="total_rating_asc">Total Stars(Low To High)</option>
                            <option value="total_rating_desc">Total Stars (High To Low)</option>
                            <option value="ratingLow">Rating (Low To High)</option>
                            <option value="ratingHigh">Rating (High To Low)</option>
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
            <!-- Begin: Table Mobile -->
            <div class="block sm:hidden intro-y">
                @foreach ($products as $product )
                    <div class="grid grid-cols-7 mt-2 text-xs border rounded-lg">
                        <div class="col-span-3 p-2 rounded-l-lg bg-primary">
                            <div class="grid gap-1 text-center text-white">
                                <div>Product Name</div>
                                <div>Number of Reviews</div>
                                <div>Total Stars</div>
                                <div>Rating</div>
                                <div></div>
                            </div>
                        </div>
                        <div class="col-span-4 p-2">
                            <div class="grid gap-1">
                                <div><a href="{{ Route('product.edit',$product) }}"> {{$product->name}}</a></div>
                                <div>{{ number_format($product->total)}}</div>
                                <div>{{ number_format($product->rate)}}</div>
                                <div class="border-b">{{ number_format($product->ave,2)}}</div>
                                <div class="text-center"><a href="{{ Route('report.ProductRatingsByCustomer',['product_id' => $product->id, 'product_name' => $product->name, 'from' => $from, 'to' => $to]) }}">View Details</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->
            <!-- Begin: products Table -->
            <div class="hidden p-3 sm:block">
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="whitespace-nowrap">Product Name</th>
                                <th class="text-center whitespace-nowrap">Number of Reviews</th>
                                <th class="text-center whitespace-nowrap">Total Stars</th>
                                <th class="text-center whitespace-nowrap">Rating</th>
                                <th class="text-center whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product )
                                <tr class="sm:text-sm">
                                    <td class="whitespace-nowrap "><a href="{{ Route('product.edit',$product) }}"> {{$product->name}}</a> </td>
                                    <td class="text-center whitespace-nowrap">{{ number_format($product->total)}}</td>
                                    <td class="text-center whitespace-nowrap">{{ number_format($product->rate)}}</td>
                                    <td class="text-center whitespace-nowrap">{{ number_format($product->ave,2)}}</td>
                                    <td class="text-center whitespace-nowrap"><a href="{{ Route('report.ProductRatingsByCustomer',['product_id' => $product->id, 'product_name' => $product->name, 'from' => $from, 'to' => $to]) }}">View Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: products Table -->
            <!-- Begin: products Pagination -->
            <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $products->onEachSide(1)->links() !!}
                </nav>
                <div class="mx-auto text-slate-500">
                    @if($products->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} entries
                    @endif
                </div>
                <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            <!-- End: products Pagination -->
        </div>
    </div>
</div>


