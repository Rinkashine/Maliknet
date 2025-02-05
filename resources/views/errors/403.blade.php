<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
          <meta charset="utf-8">
        <link href="{{asset('dist/images/MaliknetLogo.jpg')}}" rel="shortcut icon">

        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ env('APP_NAME') }} E-Commerce Seller">
        <meta name="keywords" content="{{ env('APP_NAME') }}">
        <meta name="author" content="Mark Joseph Manalo">
        <meta name="_token" content="{{csrf_token()}}" />
        <title>Action Forbidden</title>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <div class="container">
            <!-- BEGIN: Error Page -->
            <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
                <div class="-intro-x lg:mr-20">
                    <img alt="{{ config('app.name') }}  Image" class="h-48 lg:h-auto" src="{{ asset('dist/images/error-illustration.svg') }}">
                </div>
                <div class="text-white mt-10 lg:mt-0">
                    <div class="intro-x text-8xl font-medium">403</div>
                    <div class="intro-x text-xl lg:text-3xl font-medium mt-5">Forbidden</div>
                    <div class="intro-x text-lg mt-3">You do not have access to this action</div>
                        <a href="{{ url()->previous() }}" class="intro-x btn py-3 px-4 text-white border-white dark:border-darkmode-400 dark:text-slate-200 mt-10">Return</a>
                </div>
            </div>
            <!-- END: Error Page -->
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
</html>
