<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-base font-medium truncate">
            <a href="{{Route('report.CustomerOrderVolume')}}" class="mr-2 text-lg bg-white btn">←</a>{!! $customer_name !!}'s Bought Products
        </h2>
        @can('report_export')
            <a href="{{Route('export.CustomerByProduct',['name' => $customer_name, 'id'=>$customer_id])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>
    <div class="p-2 mt-5 sm:mt-10 intro-y box">
        <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
            <div class="mt-5 xl:flex sm:mr-auto" >
                <div class="items-center sm:flex sm:mr-4">
                    <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                    <select wire:model="sorting"  class="w-full mt-2 form-select 2xl:w-full sm:mt-0 sm:w-auto">
                        <option value="product_name_asc">Product Name (A-Z)</option>
                        <option value="product_name_desc">Product Name (Z-A)</option>
                        <option value="total_quantity_asc">Order Quantity (Low To High)</option>
                        <option value="total_quantity_desc">Order Quantity (High To Low)</option>
                    </select>
                </div>
                <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                    <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">Search</label>
                    <input wire:model.lazy="search" type="search" class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" placeholder="Search...">
                </div>
            </div>
        </div>
        <!-- Begin: product Table -->
        <div class="mt-3 sm:p-3 sm:mt-0">
            <div class="border">
                <table class="table text-xs table-fixed">
                    <thead class="bg-primary">
                        <tr class="text-white sm:text-base">
                            <th class="whitespace-nowrap ">Name</th>
                            <th class="text-center whitespace-nowrap">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                            <tr class="sm:text-sm">
                                <td class="whitespace-nowrap ">{{$product->name}}</td>
                                <td class="text-center whitespace-nowrap">{{ number_format($product->total_quantity)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End: product Table -->
        <!-- Begin: product Pagination -->
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
        <!-- End: product Pagination -->
    </div>
</div>
