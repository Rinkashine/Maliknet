<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
    <!-- BEGIN: Head -->
    <head>
        <!-- Google tag (gtag.js) -->
        <meta charset="utf-8">
        <link href="{{asset('dist/images/MaliknetLogo.jpg')}}" rel="shortcut icon">
        <link rel="stylesheet" href="{{ asset('dist/css/build.css') }}" />
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Maliknet E-Commerce Seller">
        <meta name="keywords" content="{{ config('app.name') }} ">
        <meta name="author" content="Mark Joseph Manalo">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- BEGIN: CSS Assets-->
        <script src="https://kit.fontawesome.com/1cff19edbf.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <!-- END: CSS Assets-->
        @laravelPWA
        @livewireStyles
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">

        <livewire:offline/>
        <!-- BEGIN: Mobile Menu -->
        @include('customer.component.mobile-menu')
        <!-- END: Mobile Menu -->

        @include('customer.component.top-menu')
        <!-- BEGIN: Top Bar -->
        @include('customer.component.side-menu')
        <!-- Content -->

        <div class="content content--top-nav">
            @yield('content')
        </div>
        <!-- END: Top Menu -->
        @include('customer.component.footer')
        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('dist/js/app.js') }}"></script>
        @include('sweetalert::alert')
        @livewireScripts
        <!-- END: JS Assets-->
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
        @stack('scripts')
    </body>
</html>

