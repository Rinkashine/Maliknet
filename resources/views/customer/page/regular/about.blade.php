@extends('customer.layout.base')
@section('content')
@section('title', 'About Us')
<!-- Begin: Header -->

<div class="pb-10 pt-0.5 intro-y box bg-gradient-to-b from-white via-slate-200 to-slate-100 mt-5">
    <div class="absolute invisible lg:visible">
        <img src="{{ asset('dist/images/AboutBackground.png') }}" class="object-fill">
    </div>
    <div class="px-5 py-5 mx-auto mt-4 lg:mt-8 xl:mt-16 box lg:opacity-80 md:w-full lg:w-2/3 xl:w-1/2">
        <div class="mb-5 text-4xl font-medium text-center">The Leading Dental Supply Company</div>
        <div class="text-lg text-slate-700">
            <div class="text-lg">
            Roman Dental Supplies Trading is launched in 2009 owned by Par, Roldan Vargas.
            Continuously serving high quality, wide variety of dental supplies ranging from tools, appliances and materials to dental clinics around Bulacan, Metro Manila.
            </div>
            <br>
            With our passion and strong focus on bringing value to our customer, Roman Dental Supplies launched {{ env('APP_NAME') }}.
            an online shopping app that offers easy and quick ordering and buying of dental supplies.
            A way for Roman Dental Supplies Trading to share its services, allowing many more Filipino Dental Clinics to aquire products they need.
            </div>
    </div>

<!-- End: Header -->
<!-- Begin: Main Container -->
<div class="grid grid-cols-12 gap-6 mt-5 lg:mx-5">
    <!-- BEGIN: Mission, Vision, and Core Values -->
    <div class="col-span-12 py-10 intro-y lg:col-span-4 box ">
        <i data-lucide="shield" class="block w-12 h-12 mx-auto text-primary"></i>
        <div class="mt-3 text-base font-medium text-center">Mission</div>
        <div class="w-3/4 mx-auto mt-2 text-center text-slate-500">Our Mission is to provide a fast, secure and reliable way to shop for dental products.</div>
    </div>
    <div class="col-span-12 py-10 intro-y lg:col-span-4 box">
        <i data-lucide="send" class="block w-12 h-12 mx-auto text-primary"></i>
        <div class="mt-3 text-base font-medium text-center">Vision</div>
        <div class="w-3/4 mx-auto mt-2 text-center text-slate-500">Our Vision is to Expand our services that may every Filipino utilize our services. To broaded our Horizon and serve people from different parts of the world.</div>
    </div>
    <div class="col-span-12 py-10 intro-y lg:col-span-4 box">
        <i data-lucide="trending-up" class="block w-12 h-12 mx-auto text-primary"></i>
        <div class="mt-3 text-base font-medium text-center">Core Values</div>
        <div class="w-3/4 mx-auto mt-2 text-center text-slate-500">To define who we are - how we talk, behave or react to any given situation - in essence, we are Simple, Happy and Together. These key attributes are visible at every step of the {{ env('APP_NAME') }} journey.</div>
    </div>
</div>
</div>

@endsection
@push('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMPLUYUqR8R0YvltLkdenCqsCqH2v7kvQ&callback=initMap"></script>
<script>
    // Initialize and add the map
    function initMap() {
    // The location of Uluru
    const uluru = { lat: 14.869930304129703, lng: 120.81190889325947 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: uluru,
        map: map,
    });
    }

    initMap();
    window.initMap = initMap;
</script>
@endpush

