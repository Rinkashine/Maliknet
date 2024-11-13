<div>
    <h2 class="intro-y text-lg font-medium mt-10">
        Transaction List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <div class="flex w-full sm:w-auto">
                <div class="w-48 relative text-slate-500">
                    <input wire:model.lazy="search" type="search" class="form-control w-48 box " placeholder="Search by Order ID...">
                </div>
                <select wire:model="sorting" class="form-select box ml-2">
                    <option value="">Status</option>
                    <option value="Pending For Approval">Pending For Approval</option>
                    <option value="Processing">Processing</option>
                    <option value="Packed">Packed</option>
                    <option value="Out For Delivery">Out For Delivery</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Return Request Rejected">Return Rejected</option>
                    <option value="Refunded">Refunded</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <div class="hidden xl:block mx-auto text-slate-500">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} entries</div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Order ID</th>
                        <th class="whitespace-nowrap">BUYER NAME</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="whitespace-nowrap">PAYMENT</th>
                        <th class="text-right whitespace-nowrap">
                            <div class="pr-16">TOTAL TRANSACTION</div>
                        </th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="intro-x">
                            <td class="w-40 !py-4">
                                <a href="{{ Route('orders.show',$order->id) }}" class="underline decoration-dotted whitespace-nowrap">
                                    #{{ $order->id }}
                                </a>
                            </td>
                            <td class="w-40">
                                <a class="font-medium whitespace-nowrap">
                                    {{ $order->customers->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if($order->status == "Completed" || $order->status == "Refunded")
                                <div class="flex items-center justify-center whitespace-nowrap text-primary">{{ $order->status }}</div>
                                @elseif($order->status == "Rejected" || $order->status == "Cancelled" || $order->status == "Return Request Rejected")
                                <div class="flex items-center justify-center whitespace-nowrap text-danger">{{ $order->status }}</div>
                                @else
                                <div class="flex items-center justify-center whitespace-nowrap text-pending">{{ $order->status }}</div>
                                @endif
                            </td>
                            <td><div class="whitespace-nowrap">{{ $order->mode_of_payment }}</div></td>
                            <td class="w-40 text-center">
                                <div class="pr-16">₱
                                    @php
                                        $total = 0
                                    @endphp
                                    @foreach ($order->orderTransactions as $item)
                                        <?php $total += $item->quantity * $item->price ?>
                                    @endforeach
                                    {{number_format($total,2)}}
                                </div>
                            </td>
                            <td class="table-report__action">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center text-primary whitespace-nowrap mr-5" href="{{ Route('orders.show',$order->id) }}">
                                        <i class=" fa-regular fa-square-check w-4 h-4 mr-1"></i> View Details
                                     </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Results Found <strong class="ml-1"> {{ $search }}</strong> </td>
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
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>


@push('scripts')
<script>
    //Open Change Order Status Modal
    const ChangeorderstatusModal = tailwind.Modal.getInstance(document.querySelector("#change-order-status-modal"));
    window.addEventListener('openChangeorderstatusModal',event=>{
        ChangeorderstatusModal.show();
    });
    //Hide Change Order Status Modal
    window.addEventListener('CloseChangeorderstatusModal',event=>{
        ChangeorderstatusModal.hide();
    });
     //Hide Modal and Refresh its value
     const RefreshChangeorderstatusModal = document.getElementById('change-order-status-modal')
     RefreshChangeorderstatusModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
</script>
@endpush
