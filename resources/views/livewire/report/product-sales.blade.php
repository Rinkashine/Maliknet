<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index')}}" class="mr-2 bg-white btn">←</a> Product Sales
        </h2>
        @can('report_export')
            <a href="{{Route('export.ProductSales',['sorting'=>$sorting,'startdate'=>$from,'enddate'=>$to])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="intro-y box sm:mt-10">
        <div class="p-2 mt-5">

            <div class="flex sm:p-3 flex-col sm:flex-row sm:items-end xl:items-start">
                <div class="xl:flex sm:mr-auto mt-5" >
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                        <select wire:model="sorting"  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                            <option value="product_name_asc">Product Name (A-Z)</option>
                            <option value="product_name_desc">Product Name (Z-A)</option>
                            <option value="total_sales_asc">Total Sales (Low To High)</option>
                            <option value="total_sales_desc">Total Sales (High To Low)</option>
                            <option value="order_quantity_asc">Order Quantity (Low To High)</option>
                            <option value="order_quantity_desc">Order Quantity (High To Low)</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">From:</label>
                        <input class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" wire:model="from" id="from" name ="from"  type="datetime-local" max="{{ $to }}" />
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">To:</label>
                        <input type="datetime-local" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" id="to" name ="to" wire:model="to" min="{{ $from }}"/>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                        <input wire:model.lazy="search" type="search" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                    </div>
                </div>
            </div>

            <!-- Begin: Table Mobile -->
            <div class="block sm:hidden intro-y sm:hidden block">
                @foreach ($products as $product )
                    <div class="grid grid-cols-10 mt-2 text-xs border rounded-lg">
                        <div class="col-span-2 p-2 rounded-l-lg bg-primary">
                            <div class="text-center text-white">
                                <div>Name</div>
                                <div>Quantity</div>
                                <div>Sales</div>
                            </div>
                        </div>
                        <div class="col-span-8 p-2">
                            <div>
                                <div class="truncate">{{$product->name}}</div>
                                <div>{{$product->quantity}}</div>
                                <div>₱ {{number_format($product->total_sales,2)}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->

            <!-- Begin: Product Reports Table -->
            <div class="sm:p-3 sm:block hidden">
                <div class="border">
                    <table class="table table-fixed text-xs">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="whitespace-nowrap ">Product Name</th>
                                <th class="whitespace-nowrap text-center">Total Quantity</th>
                                <th class="whitespace-nowrap text-center">Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($products as $product )
                            <tr class="sm:text-sm">
                                <td class="whitespace-nowrap ">{{$product->name}}</td>
                                <td class="whitespace-nowrap text-center">{{$product->quantity}}</td>
                                <td class="whitespace-nowrap text-center">₱ {{number_format($product->total_sales,2)}}</td>
                            </tr>
                        @empty
                            <tr class="sm:text-sm">
                                <td class="whitespace-nowrap" colspan="3">No Data Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Product Reports Table -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
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
                <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                    <option>15</option>
                    <option>30</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
    </div>
</div>

