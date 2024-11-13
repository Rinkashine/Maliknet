@extends('admin.layout.admin')
@section('content')
@section('title', 'Order')
<!-- Begin: Intro Header -->
<div class="intro-y flex justify-between items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Transaction Details
        </h2>
    </div>

    <div>
        @livewire('admin.transaction.order-waybill',['orderdetails' => $orderdetails])
    </div>

</div>
<!-- End: Intro Header -->
<!-- BEGIN: Transaction Details -->
@livewire('admin.transaction.order-details',['orderdetails' => $orderdetails])
<!-- END: Transaction Details -->

@endsection
