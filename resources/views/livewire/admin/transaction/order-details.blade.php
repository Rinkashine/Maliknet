<div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 2xl:col-span-3">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Transaction Details</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-rectangle-list text-slate-500 mr-2"></i>
                    Order ID:
                    <div class="underline decoration-dotted ml-1">#{{ $orderdetails->id }}</div>
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-calendar  text-slate-500 mr-2"></i>
                    Purchase Date: {{$orderdetails->created_at->toFormattedDateString() }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-timeline text-slate-500 mr-2"></i>
                    Transaction Status:
                    @if($orderdetails->status == "Completed" || $orderdetails->status == "Delivered")
                        <span class="bg-success/20 text-success rounded px-2 ml-1">{{ $orderdetails->status }}</span>
                    @else
                        <span class="rounded px-2 ml-1">{{  $orderdetails->status}}</span>
                    @endif
                    </div>
                </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Buyer Details</div>
                    <a href="{{ Route('customer.show',$customerinfo->id) }}" class="flex items-center ml-auto text-primary"> <i class="fa-solid fa-eye mr-2"></i> View Details </a>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-user text-slate mr-2"></i> Name:
                    <a href="{{ Route('customer.show',$customerinfo->id) }}" class="underline decoration-dotted ml-1">
                        {{ $orderdetails->customers->name }}
                    </a>
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-mobile-screen-button text-slate mr-2"></i> Phone Number:
                     {{ $customerinfo->phone_number }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-envelope text-slate mr-2"></i> Email:
                    {{ $customerinfo->email }}
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Payment Details</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-regular fa-credit-card text-slate mr-2"></i> Payment Method:
                    <div class="ml-auto">{{ $orderdetails->mode_of_payment }}</div>
                </div>
                @if($orderdetails->payment_id != null)
                    <div class="flex items-center mt-3">
                        <i class="fa-regular fa-id-badge text-slate mr-2"></i> Payment ID:
                        <div class="ml-auto">{{ $orderdetails->payment_id }}</div>
                    </div>
                @endif
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-tag text-slate mr-2"></i>Total Price:
                    <div class="ml-auto">₱
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($orderdetails->orderTransactions as $item)
                            <?php $total += $item->quantity * $item->price ?>
                        @endforeach
                        {{ number_format($total,2) }}
                    </div>
                </div>
                <div class="flex items-center mt-3">
                   <i class="fa-solid fa-truck-fast text-slate mr-2"></i> Shipping Fee:
                    <div class="ml-auto">₱{{ number_format($orderdetails->shippingfee,2) }}</div>
                </div>

                <div class="flex items-center border-t border-slate-200/60 dark:border-darkmode-400 pt-5 mt-5 font-medium">
                    <i class="fa-solid fa-cash-register text-slate mr-2"></i> Grand Total:
                    <div class="ml-auto">₱{{ number_format($total+$orderdetails->shippingfee,2) }}</div>
                </div>
            </div>
            <div class="box p-5 rounded-md mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Shipping Information</div>
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-person-chalkboard text-slate mr-2"></i>
                    Received By: {{ $orderdetails->received_by }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-phone text-slate mr-2"></i>
                    Receiver Phone Number: {{ $orderdetails->phone_number }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-address-book text-slate mr-2"></i>
                    Receiver Address: {{ $orderdetails->house }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-solid fa-location-dot text-slate mr-2"></i>
                    Postal Code: {{ $orderdetails->province }}~{{ $orderdetails->city }}~{{ $orderdetails->barangay }}
                </div>
                <div class="flex items-center mt-3">
                    <i class="fa-regular fa-note-sticky text-slate mr-2"></i>
                    Notes: {{ $orderdetails->notes }}
                </div>

            </div>
        </div>

        <div class="col-span-12 2xl:col-span-9">
            <div class="box p-5 rounded-md">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                    <div class="font-medium text-base truncate">Order Details</div>
                    @if($orderdetails->order_notes  == null)
                    <button wire:click="selectItem({{$orderdetails->id}},'StoreOrderNotes')" class="flex items-center ml-auto text-primary">
                        <i class="fa-solid fa-plus mr-2"></i> Add Notes
                    </button>
                    @endif
                </div>
                <div class="overflow-auto lg:overflow-visible -mt-3">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap !py-5">Product Name</th>
                                <th class="whitespace-nowrap text-right">Unit Price</th>
                                <th class="whitespace-nowrap text-right">Qty</th>
                                <th class="whitespace-nowrap text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="whitespace-nowrap ml-4">
                               {{ $product->product_name }}
                                </td>
                                <td class="text-right">₱{{ number_format($product->price,2) }}</td>
                                <td class="text-right">{{ number_format($product->quantity) }}</td>
                                <td class="text-right">₱{{ number_format($product->quantity * $product->price,2) }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <livewire:admin.transaction.order-note-modal/>

            <!-- Begin: Rejected Reason -->
            @if($orderdetails->rejected_reason  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Rejected Order Reason:</div>
                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        {{ $orderdetails->rejected_reason }}
                    </div>
                </div>
            @endif
            <!-- End: Rejected Reason -->

            <!-- Begin: Notes -->
            @if($orderdetails->order_notes  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Notes:</div>
                        <button wire:click="selectItem({{$orderdetails->id}},'StoreOrderNotes')" class="flex items-center ml-auto text-primary">
                            <i class="fa-solid fa-pencil mr-2"></i>  Edit
                        </button>

                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        {{ $orderdetails->order_notes }}
                    </div>
                </div>
            @endif
            <!-- End: Notes -->

            <!-- Begin: Cancellation In-Development -->
            @if($orderdetails->cancellation_reason  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Cancel Reason of Customer:</div>
                        @if($orderdetails->cancellation_reason  != null)
                        <a href="" class="flex items-center ml-auto text-primary">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Edit
                        </a>
                        @endif
                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        Main Reason:{{ $orderdetails->cancellation_reason->name }}
                    </div>
                    <div>
                        Detailed Reason: {{ $orderdetails->cancellation_details }}
                    </div>
                </div>
            @endif
            <!-- End: Cancellation -->
            @if($orderdetails->refund_reason_id  != null)
                <div class="box p-5 rounded-md mt-5">
                    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                        <div class="font-medium text-base truncate">Cancel Reason of Customer:</div>

                    </div>
                    <div class="overflow-auto lg:overflow-visible -mt-3">
                        Main Reason:{{ $orderdetails->refund_reason->name }}
                    </div>
                    <div>
                        Detailed Reason: {{ $orderdetails->details }}
                    </div>
                    <div>

                    </div>
                </div>
                <div class="grid grid-cols-12 gap-5 mt-5">
                @foreach ($orderdetails->return_request_photo as $item)
                <div class="box intro-y p-5 col-span-12 sm:col-span-6">
                    <img alt="Missing Image" class="object-contain h-96 rounded-md w-full" data-action="zoom" src="{{ url('storage/return_images/'.$item->images) }}">
                </div>

                @endforeach
                </div>
            @endif


            <!-- Begin: Reject Order Modal -->
            <livewire:admin.transaction.order-reject-form/>
            <livewire:admin.transaction.order-approved-form/>
            <livewire:admin.transaction.set-status-to-packed/>
            <livewire:admin.transaction.order-out-for-delivery-modal/>
            <livewire:admin.transaction.order-completed-modal/>

            <livewire:admin.transaction.order-accept-return-modal/>
            <livewire:admin.transaction.order-reject-return-modal/>

            <!-- End: Reject Order Modal -->
            <!-- Begin: Set Status To Packed Modal -->
            <!-- End: Set Status To Packed Modal -->

            @if($orderdetails->status == "Pending for Approval")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <button wire:click="selectItem({{ $orderdetails->id }},'reject_order')" class="btn btn-danger">  Reject </button>
                    <button wire:click="selectItem({{ $orderdetails->id }},'approve_order')" class="btn btn-primary">  Approve </button>
                </div>
            @elseif($orderdetails->status == "Processing")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <button wire:click="selectItem({{ $orderdetails->id }},'reject_order')" class="btn btn-danger">  Reject </button>
                    <button wire:click="selectItem({{ $orderdetails->id }},'set_status_to_packed')" class="btn btn-primary">  Set Status To Packed </button>
                </div>
            @elseif($orderdetails->status == "Packed")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <button wire:click="selectItem({{ $orderdetails->id }},'reject_order')" class="btn btn-danger">  Reject </button>
                    <button wire:click="selectItem({{ $orderdetails->id }},'set_status_to_out_for_delivery')" class="btn btn-primary">Set Status To Out for Delivery </button>
                </div>
            @elseif($orderdetails->status == "Out For Delivery")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <button wire:click="selectItem({{ $orderdetails->id }},'reject_order')" class="btn btn-danger">  Reject </button>
                    <button wire:click="selectItem({{ $orderdetails->id }},'set_status_to_completed')" class="btn btn-primary">Set Status To Completed</button>
                </div>
             @elseif($orderdetails->status == "Requesting For Refund")
                <div class="mt-5 intro-y flex justify-end gap-2">
                    <button wire:click="selectItem({{ $orderdetails->id }},'reject_return')" class="btn btn-danger">  Reject Return</button>
                    <button wire:click="selectItem({{ $orderdetails->id }},'accept_return')" class="btn btn-primary">Approved Return</button>
                </div>
            @endif
        </div>
    </div>

    <div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
        <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium" id="title"></div>
            <div class="text-slate-500 mt-1" id="message"></div>
         </div>
    </div>
    @push('scripts')
        <script>
            const setNoteModal = tailwind.Modal.getInstance(document.querySelector("#order-notes-modal"));
            window.addEventListener('openOrderNotesModal',event => {
                setNoteModal.show();
            });

            window.addEventListener('closeOrderNotesModal',event => {
                setNoteModal.hide();
            });


            //Begin: Set Status To Processing
            const setApproveOrderModal = tailwind.Modal.getInstance(document.querySelector("#order-approved-modal"));
            window.addEventListener('ShowApprovedOrderModal',event => {
                setApproveOrderModal.show();
            });

            window.addEventListener('closeApprovedModal',event => {
                setApproveOrderModal.hide();
            });


            //End: Set Status To Processing
            //Begin: Set Reject Order
            const setRejectOrderModal = tailwind.Modal.getInstance(document.querySelector("#order-reject-modal"));

            window.addEventListener('openRejectOrderModal',event => {
                setRejectOrderModal.show();
            });

            window.addEventListener('closeRejectModal',event => {
                setRejectOrderModal.hide();
            });

            //End: Set Reject Order
            //Begin: Set Status To Packed
            const setOrderToPackedModal = tailwind.Modal.getInstance(document.querySelector("#set-status-to-packed-modal"));

            window.addEventListener('HideSetOrderToPackedModal',event => {
                setOrderToPackedModal.hide()
            });
            window.addEventListener('ShowSetOrderToPackedModal', event => {
                setOrderToPackedModal.show()
            });
            //End: Set Status To Packed
            //Begin: Set Status for Out For Delivery
            const setOrderToOutForDeliveryModal = tailwind.Modal.getInstance(document.querySelector("#set-status-to-out-for-delivery-modal"));

            window.addEventListener('ShowOutForDeliveryModal',event => {
                setOrderToOutForDeliveryModal.show()
            });
            window.addEventListener('HideOutForDeliveryModal', event => {
                setOrderToOutForDeliveryModal.hide()
            });
            //End: Set Status for Out For Delivery

            //Begin: Set Status To Completed
            const setOrderCompleted = tailwind.Modal.getInstance(document.querySelector("#set-status-completed-modal"));

            window.addEventListener('ShowCompletedModal',event => {
                setOrderCompleted.show()
            });

            window.addEventListener('HideCompletedModal', event => {
                setOrderCompleted.hide()
            });
            //End: Set Status To Completed
            //Begin: Reject Return Modal
            const rejectReturn = tailwind.Modal.getInstance(document.querySelector("#reject-return-confirmation-modal"));

            window.addEventListener('openRejectReturnModal',event => {
                rejectReturn.show()

            });

            window.addEventListener('closeRejectReturnModal', event => {
                rejectReturn.hide()
            });
            //End: Reject Return Modal
            //Begin: Accept Return Modal
            const acceptReturn = tailwind.Modal.getInstance(document.querySelector("#accept-return-confirmation-modal"));

            window.addEventListener('openAcceptReturnModal',event => {
                acceptReturn.show()
            });

            window.addEventListener('closeApprovedReturn', event => {
                acceptReturn.hide()
            });
            //End: Accept Return Modal
        window.addEventListener('SuccessAlert',event => {
            let id = (Math.random() + 1).toString(36).substring(7);
            Toastify({
                node: $("#success-notification-content") .clone() .removeClass("hidden")[0],
                duration: 7000,
                className: `toast-${id}`,
                newWindow: false,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true, }).showToast();

                const toast = document.querySelector(`.toast-${id}`)
                toast.querySelector("#title").innerText = event.detail.title
                toast.querySelector("#message").innerText = event.detail.name
            });
            //Invalid Alert
            window.addEventListener('InvalidAlert',event => {
                let id = (Math.random() + 1).toString(36).substring(7);
                Toastify({
                    node: $("#invalid-success-notification-content") .clone() .removeClass("hidden")[0],
                    duration: 7000,
                    newWindow: true,
                    className: `toast-${id}`,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true, }).showToast();

                    const toast = document.querySelector(`.toast-${id}`)
                        toast.querySelector("#title").innerText = event.detail.title
                        toast.querySelector("#message").innerText = event.detail.name
            });



            //const cancelOrderModal = document.querySelector('');

          ///  const setOrderToPackedModal = document.querySelector('#set-status-to-packed-modal');




        </script>
    @endpush
</div>
