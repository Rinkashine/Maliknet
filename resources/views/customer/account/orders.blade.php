@extends('customer.layout.base')
@section('content')
@section('title', 'Order List')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Orders Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: Display Information -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">

        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    My Orders
                </h2>
            </div>
            <div class="p-2">
                <!-- Begin: Customer Orders Table-->
                <livewire:customer.order.customer-orders-table/>
                <!-- End: Customer Orders Table-->
            </div>
        </div>
    </div>
    <!-- END: Display Information -->
</div>
<!-- End: Orders Body -->
@endsection
@push('scripts')
<script>
</script>
@endpush
