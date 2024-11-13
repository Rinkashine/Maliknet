@extends('customer.layout.base')
@section('content')
@section('title', 'Order Reviews')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Reviews Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="pb-5 intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                 <h2 class="mr-auto text-base font-medium">
                    Order Reviews
                </h2>
            </div>
                <div class="p-5">
                    @forelse ($reviews as $review)
                        <div class="mt-2 border-2 rounded-md">
                            <div class="flex flex-row justify-between mx-3 my-5">
                                <p>Purchased on <span >{{ $review->created_at }}</span></p>
                                <p>Order:
                                    <span href="{{ Route('order.show',$review->customer_order_id ) }}">{{ $review->customer_order_id }}</span>
                                </p>
                            </div>
                            <div class="px-5 py-5 border-t bg-slate-50">
                                <div class="text-base">
                                    <p>Product:
                                        <span href="{{  Route('productshow', $review->reviewTransactions->product_id )  }}">{{ $review->reviewTransactions->product_name }}
                                    </span>
                                    </p>
                                    <div class="mt-3 ">
                                    @for($x=0; $x<$review->rate; $x++)
                                        <i class="text-yellow-300 sm:text-xl fa fa-star"> </i>
                                    @endfor
                                    </div>
                                    <div class="px-3 py-3 mt-3 break-words bg-white border-2 rounded-md h-fit">{{ $review->comment }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-5 text-lg bg-gradient-to-r from-slate-50 via-white to-slate-100">
                            <img alt="Thumbs Up Image" class="block object-scale-down w-full mt-3 max-h-24 sm:hidden" src="{{ asset('dist/images/ReviewThumbsUp.svg') }}">
                            <p class="text-center sm:text-3xl bold">Your feedback matters, write us a review!</p>
                            <img alt="Write a Review Image" class="hidden object-scale-down w-full mt-3 sm:block max-h-96" src="{{ asset('dist/images/WriteaReview.svg') }}">
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- END: Display Information -->
        </div>
    </div>
    <!-- End: Reviews Body -->
@endsection
@push('scripts')
<script>
</script>
@endpush
