@extends('customer.layout.base')
@section('content')
@section('title', 'Profile Information')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Returns Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    My Returns
                </h2>
            </div>

            <div class="p-2">

                <!-- Begin: Table Mobile -->
                <div class="block sm:p-3 sm:hidden intro-y">
                    @forelse ($returns as $items)
                        <div class="grid grid-cols-5 mt-2 text-xs border rounded-lg">
                            <div class="col-span-2 p-2 rounded-l-lg bg-slate-50">
                                <div class="grid gap-1 text-center">
                                    <div>Order ID</div>
                                    <div>Product Name</div>
                                    <div>Quantity</div>
                                    <div>Returned On</div>
                                </div>
                            </div>
                            <div class="col-span-3 p-2">
                                <div class="grid gap-1">
                                    <div>"ID"</div>
                                    <div class="overflow-x-auto">"Name"</div>
                                    <div>"5"</div>
                                    <div>"Date"</div>
                                </div>
                            </div>
                        </div>
                    @empty
                    <div class="px-5 py-5 text-lg bg-gradient-to-r from-slate-50 via-white to-slate-100">
                        <img alt="Returns" class="block object-scale-down w-full mt-3 max-h-24 sm:hidden" src="{{ asset('dist/images/ReturnsMobile.svg') }}">
                        <p class="text-center sm:text-3xl bold">We're happy to keep you satisfied!</p>
                    </div>
                    @endforelse
                </div>
                <!-- End: Table Mobile -->


                <div class="hidden sm:p-3 sm:block">
                    <div class="border">
                        <table class="table table-fixed">
                            <thead class="table-light">
                                <tr>
                                    <th class="whitespace-nowrap">Order ID</th>
                                    <th class="text-center whitespace-nowrap">Product Name</th>
                                    <th class="text-center whitespace-nowrap">Quantity</th>
                                    <th class="text-center whitespace-nowrap">Returned on</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $item)
                                    <tr>
                                        <td class="whitespace-nowrap">"ID"</td>
                                        <td class="overflow-x-auto text-center whitespace-nowrap">"Name"</td>
                                        <td class="text-center whitespace-nowrap">"5"</td>
                                        <td class="text-center whitespace-nowrap">"Date"</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="px-5 py-5 text-lg">
                                            <p class="text-center sm:text-3xl bold">We're happy to keep you satisfied!</p>
                                            <img alt="Returns" class="hidden object-scale-down w-full mt-3 sm:block max-h-96" src="{{ asset('dist/images/Returns.svg') }}">
                                        </div>
                                    </td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>
<!-- End: Returns Body -->
@endsection
@push('scripts')
<script>
</script>
@endpush
