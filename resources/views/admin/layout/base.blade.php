<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{asset('dist/images/MaliknetLogo.jpg')}}" rel="shortcut icon">
        <link rel="stylesheet" href="{{ asset('dist/css/build.css') }}" />
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Maliknet E-Commerce Seller">
        <meta name="keywords" content="Maliknet">
        <meta name="author" content="Mark Joseph Manalo">
        <title>{{ config('app.name') }}  - @yield('title')</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
         <!-- Google tag (gtag.js) -->
         @laravelPWA
    </head>
    <body class="login">

        <!-- Begin Content -->
        @yield('content')
        <!-- End Content -->
        @include('sweetalert::alert')
    <script src="{{ asset('dist/js/app.js') }}"></script>
</body>
</html>
