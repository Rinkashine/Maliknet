<div>
    <h2 class="intro-y text-lg font-medium mt-10">
        Purchase Order
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
                <div class="w-48 relative text-slate-500">
                    <input wire:model.lazy="search" type="search" class="form-control w-48 box " placeholder="Search">
                </div>
                <select class="form-select box ml-2" wire:model="sorting">
                    <option value="">Status</option>
                    <option value="Draft">Draft</option>
                    <option value="Pending">Pending</option>
                    <option value="Received">Received</option>
                </select>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries</div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <a href="{{ Route('transfer.create') }}" class="btn btn-primary shadow-md mr-2">Create Transfer</a>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Purchase ID</th>
                        <th class="whitespace-nowrap text-center">Supplier</th>
                        <th class="text-center whitespace-nowrap">Status</th>
                        <th class="whitespace-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr class="intro-x">
                        <td class="w-40 !py-4"> <a href="{{ Route('transfer.edit',$order->id) }}">{{ $order->id }}</a></td>
                       <td class="w-40 text-center">{{ $order->suppliers->name }}</td>
                        <td>
                            <div class="whitespace-nowrap text-center">
                                @if($order->status == "Pending")
                                <span class="text-pending">
                                    {{ $order->status }}
                                </span>
                                @elseif($order->status == "Draft")
                                <span class="text-warning">
                                    {{ $order->status }}
                                </span>
                                @elseif($order->status == "Completed")
                                <span class="text-primary">
                                    {{ $order->status }}
                                </span>
                                @else
                                    {{ $order->status }}
                                @endif
                            </div>
                        </td>

                        <td class="table-report__action">
                            <div class="flex justify-center items-center">
                                @if($order->status == "Received")
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="{{ Route('transfer.show',$order->id) }}">
                                        <i class=" fa-regular fa-square-check w-4 h-4 mr-1"></i> View Details
                                    </a>
                                @else
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="{{ Route('transfer.edit',$order->id) }}">
                                        <i class=" fa-regular fa-square-check w-4 h-4 mr-1"></i> View Details
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="intro-x">
                        <td colspan="5">No Result Found</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $orders->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage"  class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
