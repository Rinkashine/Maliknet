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
                        <a href="{{ url()->previous() }}" class="mr-2 btn">←</a>
                    </h2>
                </div>
                <div>
                    <div class="px-2 py-2 ml-2 text-xs rounded-md bg-slate-200 text-slate-600">{{ $orderdetails->status }}</div>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="sm:text-base">
                                        <td class="overflow-x-auto whitespace-nowrap">{{ $product->product_name }}</td>
                                        <td class="text-center whitespace-nowrap">₱{{ number_format($product->price,2) }}</td>
                                        <td class="text-center whitespace-nowrap">{{ number_format($product->quantity) }}</td>
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
                Order Date: {{ $orderdetails->created_at->toFormattedDateString() }}
            </div>
            <div>
                Cancelled On: {{ $orderdetails->updated_at }}
            </div>
            <div>
                Mode of Payment: {{ $orderdetails->mode_of_payment }}
            </div>
            <div>
                Reason: {{ $orderdetails->cancellation_reason->name }}
            </div>
            @if($orderdetails->cancellation_details != null)
                <div>
                    Detailed Reason: {{ $orderdetails->cancellation_details }}
                </div>
            @endif
        </div>



    </div>
    <!-- BEGIN: Display Information -->
</div>
<!-- End: Order Details Body -->
@endsection

