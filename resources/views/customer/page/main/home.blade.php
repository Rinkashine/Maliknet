@extends('customer.layout.base')
@section('content')
@section('title', 'Home')

<!-- Begin: Header Container -->
<div class="container flex flex-col-reverse items-center gap-16 px-10 py-10 mx-20 mt-10 mb-10 box lg:flex-row ml:14">
    <!-- Content -->
    <div class="flex flex-col items-center flex-1 lg:items-start lg:pt-10">
        <h2 class="mb-6  text-center border-b-2 border-slate-400 ">
            <div class="font-medium text-2xl lg:text-5xl 2xl:text-5xl ">
                 Welcome to Team Pasay
            </div>
        </h2>
        <div class="mb-6 text-lg italic font-normal text-center text-bookmark-grey lg:text-left">
            All your Motorcycle part needs in One GO! Shop Now!
        </div>
    </div>
    <div class=" justify-center flex-1 hidden w-full mb-5 md:flex md:mb-16 lg:mb-0">
        @if(count($banners) == 0)
            <img class=" h-5/6 sm:w-3/4" src="{{ asset('dist/images/undraw_web_shopping.svg') }}" alt="" />
        @else
            <div class="home-mode" >
                @foreach ($banners as $banner)
                    <div class="px-2 h-72">
                        <div class="object-cover h-full overflow-hidden rounded-md"  >
                            @if (Storage::disk('public')->exists('banner/'.$banner->featured_image))
                                <img alt="Image Not Found" class="object-contain h-full w-full " src="{{ url('storage/banner/'.$banner->featured_image) }}" data-action="zoom">
                            @else
                                <img alt="Missing Image" class="object-fill h-full w-96 " src="{{  asset('dist/images/MaliknetLogo.jpg') }}" data-action="zoom">
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div >
<!-- End: Header Container -->
<!-- Begin: Main Container -->
<div class="container">
    <!-- Begin: Product List -->
    <div>
        <div>
            <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
                Product List
            </p>
        </div>
        <div class="my-5  pt-5 pb-5 pl-2 pr-2">
                    <livewire:customer.productcatalog.product-catalog-table/>

        </div>
    </div>
    <!-- End: Product List -->
</div>
<!-- End: Main Container -->
@endsection
