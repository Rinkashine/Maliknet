<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.index')}}" class="mr-2 bg-white btn">←</a> Customer Expenditure
        </h2>
        @can('report_export')
            <a href="{{Route('export.CustomerTotalSpent',['sorting'=>$sorting,'startdate'=>$from,'enddate'=>$to])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="intro-y sm:mt-10 box">
        <div class="p-2 mt-5">

            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-end xl:items-start">
                <div class="xl:flex sm:mr-auto mt-5" >
                    <div class="sm:flex items-center sm:mr-4">
                        <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                        <select wire:model="sorting"  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                            <option value="customer_name_asc">Customer Name (A-Z)</option>
                            <option value="customer_name_desc">Customer Name (Z-A)</option>
                            <option value="total_spent_asc">Total Spent(Low To High)</option>
                            <option value="total_spent_desc">Total Spent (High To Low)</option>
                        </select>
                    </div>
                    <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                        <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">From:</label>
                        <input  class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" wire:model="from" id="from" name ="from"  type="datetime-local" max="{{ $to }}" />
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
            <div class="block sm:hidden intro-y">
                @foreach ($customers as $customer)
                    <div class="grid grid-cols-5 mt-2 text-xs border rounded-lg">
                        <div class="col-span-2 p-2 rounded-l-lg bg-primary">
                            <div class="text-center text-white">
                                <div>Name</div>
                                <div>Email</div>
                                <div>Total Spent</div>
                            </div>
                        </div>
                        <div class="col-span-3 p-2">
                            <div>
                                <div>{{$customer->name}}</div>
                                <div class="truncate">{{$customer->email}}</div>
                                <div>₱{{ number_format($customer->total_spent,2)}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->

            <!-- Begin: Customers Table -->
            <div class="sm:p-3 sm:block hidden">
                <div class="border">
                    <table class="table table-fixed text-xs">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <th class="whitespace-nowrap ">Customer Name</th>
                                <th class="whitespace-nowrap text-center">Customer Email</th>
                                <th class="whitespace-nowrap text-center">Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer )
                                <tr class="sm:text-sm">
                                    <td class="whitespace-nowrap ">{{$customer->name}}</td>
                                    <td class="whitespace-nowrap text-center">{{$customer->email}}</td>
                                    <td class="whitespace-nowrap text-center">₱{{ number_format($customer->total_spent,2)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Customers Table -->

            <!-- Begin: Customers Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $customers->onEachSide(1)->links() !!}
                </nav>
                <div class="mx-auto text-slate-500">
                    @if($customers->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$customers->firstItem()}} to {{$customers->lastItem()}} of {{$customers->total()}} entries
                    @endif
                </div>
                <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
            <!-- End: Customers Pagination -->
        </div>
    </div>
</div>

