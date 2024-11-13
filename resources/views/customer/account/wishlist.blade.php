@extends('customer.layout.base')
@section('content')
@section('title', 'Wishlist')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Reviews Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        My Wishlist
                    </h2>
                </div>
                <div class="p-2">
                    <!-- Begin: Customer Wishlist Products Table -->
                    <livewire:customer.wishlist.product-wishlist/>
                    <!-- End: Customer Wishlist Product Table -->
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
@endsection
