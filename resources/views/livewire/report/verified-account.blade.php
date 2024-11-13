<div>
    <!-- Title and Export Button -->
    <div class="flex items-center justify-between mt-5 intro-y">
        <h2 class="mr-auto text-lg font-medium">
            <a href="{{Route('report.AccountVerification')}}" class="mr-2 bg-white btn">←</a>Verified Accounts
        </h2>
        @can('report_export')
            <a href="{{Route('report.exportVerifiedAccountsExcel',['sorting' => $sorting])}}" class="btn btn-primary">Export</a>
        @endcan
    </div>

    <div class="sm:mt-10 intro-y box">
        <div class="p-2 mt-5 border-slate-200/60 dark:border-darkmode-400">

            <div class="flex flex-col sm:p-3 sm:flex-row sm:items-start">
                <div class="mt-5 xl:flex sm:mr-auto" >
                    <div class="items-center sm:flex sm:mr-4">
                        <label class="flex-none mr-2 xl:w-auto xl:flex-initial">Sort</label>
                        <select wire:model="sorting"  class="w-full mt-2 form-select 2xl:w-full sm:mt-0 sm:w-auto">
                            <option value="customer_name_asc">Customer Name (A-Z)</option>
                            <option value="customer_name_desc">Customer Name (Z-A)</option>
                        </select>
                    </div>
                    <div class="items-center mt-2 sm:flex sm:mr-4 xl:mt-0">
                        <label class="flex-none w-12 mr-2 xl:w-auto xl:flex-initial">Search</label>
                        <input wire:model.lazy="search" type="search" class="mt-2 form-control sm:w-40 2xl:w-full sm:mt-0" placeholder="Search...">
                    </div>
                </div>
            </div>

            <!-- Begin: Table Mobile -->
            <div class="block sm:hidden intro-y">
                @foreach ($verified as $accounts)
                    <div class="grid grid-cols-4 mt-2 text-xs border rounded-lg">
                        <div class="col-span-1 p-2 rounded-l-lg bg-primary">
                            <div class="text-center text-white">
                                <div>Name</div>
                                <div>Email</div>
                            </div>
                        </div>
                        <div class="col-span-3 p-2">
                            <div>
                                <div>{{$accounts->name}}</div>
                                <div>{{$accounts->email}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End: Table Mobile -->

            <!-- Begin: Brand Table Desktop -->
            <div class="hidden sm:p-3 sm:block intro-y" >
                <div class="border">
                    <table class="table text-xs table-fixed">
                        <thead class="bg-primary">
                            <tr class="text-white sm:text-base">
                                <td class="whitespace-nowrap">Name</td>
                                <td class="text-center whitespace-nowrap">Email</td>
                            </tr>
                        </thead>
                        <tbody class="bg-slate-50">
                        @foreach ($verified as $accounts)
                            <tr class="sm:text-sm">
                                <td class="wwhitespace-nowrap">{{$accounts->name}}</td>
                                <td class="text-center whitespace-nowrap">{{$accounts->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End: Brand Table Desktop -->

            <div class="flex flex-wrap items-center mt-5 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="w-full sm:w-auto sm:mr-auto">
                    {!! $verified->onEachSide(1)->links() !!}
                </nav>

                <div class="mx-auto text-slate-500">
                    @if($verified->count() == 0)
                        Showing 0 to 0 of 0 entries
                    @else
                        Showing {{$verified->firstItem()}} to {{$verified->lastItem()}} of {{$verified->total()}} entries
                    @endif
                </div>

                <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

        </div>
    </div>
</div>
