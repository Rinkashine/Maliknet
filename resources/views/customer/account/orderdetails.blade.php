@extends('customer.layout.base')
@section('content')
@section('title', 'Order Details')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Order Details Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: Display Information -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center justify-between p-5 border-b border-slate-200/60">
                <div>
                    <h2 class="mr-auto text-base font-medium">
                        <a href="{{ url()->previous() }}" class="mr-2 shadow-md btn">←</a>
                    </h2>
                </div>
                <div>
                    @if($orderdetails->status == "Rejected" || $orderdetails->status == "Cancelled" || $orderdetails->status == "Return Request Rejected")
                        <div class="w-full mb-2 mr-1 btn btn-rounded btn-danger-soft">{{ $orderdetails->status }}</div>
                    @elseif($orderdetails->status == "Completed")
                        <div class="w-full text-xs btn btn-rounded btn-success-soft ">{{ $orderdetails->status }}</div>
                    @else
                        <div class="px-2 py-2 ml-2 text-xs rounded-md bg-slate-200 text-slate-600">{{ $orderdetails->status }}</div>
                    @endif
                </div>
            </div>
            <div class="p-2">
                <div class="sm:p-3">
                    <div class="border">
                        <table class="table text-xs table-fixed">
                            <thead class="bg-slate-50">
                                <tr class="sm:text-base">
                                    <th class="whitespace-nowrap">Product Name</th>
                                    <th class="text-center whitespace-nowrap">Price</th>
                                    <th class="text-center whitespace-nowrap">Quantity</th>
                                    @if($orderdetails->status == "Completed")
                                        <th class="text-center whitespace-nowrap">Action</th>
                                    @endif
                                    </thead>
                                </tr>
                            <tbody class="sm:text-sm">
                                @foreach ($orderdetails->orderTransactions as $order)
                                    <tr>
                                        <td class="overflow-x-auto whitespace-nowrap"> <a href="{{ Route('productshow',$order->product_id) }}">{{ $order->product_name }}</a></td>
                                        <td class="text-center whitespace-nowrap">₱{{ number_format($order->price,2) }}</td>
                                        <td class="text-center whitespace-nowrap">{{ number_format($order->quantity) }}</td>
                                        @if($orderdetails->status == "Completed")
                                            @if($order->reviewTransactions->count()  == 0)
                                                <td class="text-center whitespace-nowrap text-success">
                                                    <a onclick="setProductToReview('{{$order->product_name}}', {{$order->id}})" href="javascript:;">
                                                        <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i> Make a review
                                                    </a>
                                                </td>
                                            @else
                                                <td class="text-center whitespace-nowrap">Reviewed</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-5 mt-5 intro-y box">
            <div>
                Order ID:{{ $orderdetails->id }}
            </div>
            <div>
                Placed On: {{ $orderdetails->created_at->toFormattedDateString() }}
            </div>
            <div>
                Mode of Payment: {{ $orderdetails->mode_of_payment }}
            </div>
            @if($orderdetails->payment_id != null)
            <div>
                Payment ID: {{ $orderdetails->payment_id }}
            </div>
            @endif
        </div>
        <div class="flex flex-col justify-between gap-5 md:flex-col lg:flex-row 2xl:flex-row sm:flex-col ">
            <div class="w-full p-5 mt-5 intro-y box">
                <div class="font-medium">Shipping Information</div>
                <div class="w-full mt-1 mb-2 border-t border-slate-200/60"></div>
                <div>
                    Receiver: {{ $orderdetails->received_by }}
                </div>
                <div>
                    Phone Number: {{ $orderdetails->phone_number }}
                </div>
                <div>
                    Notes: {{ $orderdetails->notes }}
                </div>
                <div>
                    Address {{ $orderdetails->house }}
                </div>
                <div>
                    Postal Code: {{ $orderdetails->province }}~{{ $orderdetails->city }}~{{ $orderdetails->barangay }}
                </div>
            </div>
            <div class="w-full p-5 mt-5 intro-y box">
                <div class="font-medium">Total Summary</div>
                <div class="w-full mt-1 mb-2 border-t border-slate-200/60"></div>

                <div class="flex justify-between">
                    <div>Total</div>
                    <div>₱
                        @php
                            $total = 0
                        @endphp
                        @foreach ($orderdetails->orderTransactions as $item)
                            <?php $total += $item->quantity * $item->price ?>
                        @endforeach
                        {{ number_format($total,2) }}
                    </div>
                </div>
            </div>
        </div>

        @if($orderdetails->status == "Rejected")
            <div class="p-5 mt-5 box intro-y">
                Rejected Order Reason: {{ $orderdetails->rejected_reason }}
            </div>
        @endif
        @livewire('customer.order.cancel-order',['orderdetails' => $orderdetails])
        <livewire:customer.order.cancel-order-modal/>

        <!-- Begin: Product Review Modal -->
        <livewire:customer.review.product-review-form :orderDetails="$orderdetails" >
        <!-- End: Product Review Modal -->
    </div>
    <!-- BEGIN: Display Information -->
</div>
<!-- End: Order Details Body -->
@endsection
@push('scripts')
<script>
     //Show Edit Form Modal
     const cancelOrderModal = tailwind.Modal.getInstance(document.querySelector("#cancel-order-modal"));
    window.addEventListener('openCancelModal',event => {
        cancelOrderModal.show();
    });
    //Hide Add Form Modal
    window.addEventListener('CloseOrderCancellationModal',event => {
        cancelOrderModal.hide();

    });
    //Closing Modal and Refreshing its value
    const ForceCloseCancelOrderModal = document.getElementById('cancel-order-modal')
    ForceCloseCancelOrderModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //Reviews
    const reviewModalElement = document.querySelector("#review-product-modal");
    const reviewModal =  tailwind.Modal.getOrCreateInstance(reviewModalElement)
    const setProductToReview = (productName, productId)=>{
        livewire.emit("selectProductToReview", productName, productId);
    }

    window.addEventListener('CloseReviewModal',event => {
        reviewModal.hide()
    });
    window.addEventListener('ShowReviewModal', event => {
        reviewModal.show()
    });
    window.addEventListener('swal:modal',event =>{
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.type
        })
    });
    const requestrefundmodal = tailwind.Modal.getInstance(document.querySelector("#request-refund-modal"));
    const RequestRefund = (orderid)=>{
        livewire.emit("RequestforRefund",orderid);
    }
    window.addEventListener('closeRequestForRefundModal',event => {
        requestrefundmodal.hide()
    });
    window.addEventListener('openRequestForRefundModal', event => {
        requestrefundmodal.show()
    });

</script>
@endpush
