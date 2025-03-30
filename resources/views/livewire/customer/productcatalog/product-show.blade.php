<div>
    <div class="flex items-center justify-center">
        <div style="width:60rem">
            <!-- Begin Header of Product -->
            <div class="px-5 pt-5 intro-y box mt-7">
                <div class="flex flex-col pb-5 -mx-5 border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
                    <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                        <div class="ml-5 mr-5 text-lg">
                            <div class="font-medium sm:text-xl sm:whitespace-normal">{{$product->name}}</div>
                            <div class="text-slate-500">{{ $product->category->name }}</div>
                        </div>
                        <div class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r lg:mt-0 border-slate-200/60 dark:border-darkmode-400 lg:border-t-0 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">Product Details</div>
                            <div class="flex flex-col items-center justify-center mt-4 lg:items-start">
                                <div class="flex items-center truncate sm:whitespace-normal"> Sold:  {{ $sold }}</div>
                                <div class="flex items-center mt-3 truncate sm:whitespace-normal">Ratings: {{ number_format($ave_rate,2)}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center flex-1 px-0 pt-5 mt-6 border-t lg:mt-0 lg:border-0 border-slate-200/60 dark:border-darkmode-400 lg:pt-0">
                        @livewire('customer.productcatalog.add-to-cart',['product' => $product])
                    </div>
                </div>
            </div>
            <div class="mt-5 tab-content">
                <div>
                    <div class="grid grid-cols-12 gap-6">
                        <!-- BEGIN: Product Details -->
                        <div class="col-span-12 intro-y box lg:col-span-6">
                            <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="mr-auto text-base font-medium">
                                    Product Description
                                </h2>
                                @livewire('customer.productcatalog.add-to-wishlist',['product'=> $product])
                            </div>
                            <div class="p-5">
                                <div class="text-slate-500 text-base	 mt-0.5">{!! $product->description !!}</div>
                            </div>
                        </div>
                        <!-- END: Product Details -->
                        <!-- BEGIN: Product Image -->
                        <div class="col-span-12 intro-y box lg:col-span-6">
                            <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
                                <h2 class="mr-auto text-base font-medium">
                                    Product Image
                                </h2>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-center">
                                    @php
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv'];

                                    // Filter images and videos separately
                                    $imageFiles = $product->galleries->filter(function ($gallery) use ($imageExtensions) {
                                        return in_array(strtolower(pathinfo($gallery->file, PATHINFO_EXTENSION)), $imageExtensions);
                                    });

                                    $videoFiles = $product->galleries->filter(function ($gallery) use ($videoExtensions) {
                                        return in_array(strtolower(pathinfo($gallery->file, PATHINFO_EXTENSION)), $videoExtensions);
                                    });
                                @endphp

                                @if ($product->galleries->isEmpty())
                                    <!-- No media available -->
                                    <div>
                                        <img alt="Missing Image" class="object-fill w-full h-full"
                                             src="{{ asset('dist/images/MaliknetLogo.jpg') }}">
                                    </div>

                                @elseif ($product->galleries->count() == 1)
                                    <!-- Single Media (Image or Video) -->
                                    @foreach ($product->galleries as $gallery)
                                        <div>
                                            @php $fileExtension = strtolower(pathinfo($gallery->file, PATHINFO_EXTENSION)); @endphp

                                            @if (in_array($fileExtension, $imageExtensions))
                                                <!-- Display Image -->
                                                @if (Storage::disk('public')->exists('product_gallery/'.$gallery->file))
                                                    <img alt="Product Image" data-action="zoom"
                                                         class="object-fill w-full h-full"
                                                         src="{{ url('storage/product_gallery/'.$gallery->file) }}">
                                                @else
                                                    <img alt="Missing Image" class="object-scale-down w-full h-48 rounded-md"
                                                         src="{{ asset('dist/images/ImageNotFound.png') }}">
                                                @endif

                                            @elseif (in_array($fileExtension, $videoExtensions))
                                                <!-- Display Video -->
                                                <video class="w-full h-full" controls>
                                                    <source src="{{ url('storage/product_gallery/'.$gallery->file) }}"
                                                            type="video/{{ $fileExtension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach

                                @else
                                    <!-- Media Slider -->
                                    <div class="pb-8 mx-6 mt-5">
                                        <div class="fade-mode" style="height: 100%;">
                                            @foreach ($product->galleries as $gallery)
                                                <div class="h-64 px-2">
                                                    <div class="object-fill w-full h-full" style="height: 100%;">
                                                        @php $fileExtension = strtolower(pathinfo($gallery->file, PATHINFO_EXTENSION)); @endphp

                                                        @if (in_array($fileExtension, $imageExtensions))
                                                            <!-- Display Image -->
                                                            @if (Storage::disk('public')->exists('product_gallery/'.$gallery->file))
                                                                <img alt="Product Image" src="{{ url('storage/product_gallery/'.$gallery->file) }}"
                                                                     data-action="zoom" style="height: 100%;" class=""/>
                                                            @else
                                                                <img alt="Missing Image" src="{{ asset('dist/images/ImageNotFound.png') }}"
                                                                     data-action="zoom" style="height: 100%;" class="object-scale-down w-full h-48 rounded-md"/>
                                                            @endif

                                                        @elseif (in_array($fileExtension, $videoExtensions))
                                                            <!-- Display Video -->
                                                            <video class="w-full h-full" controls muted>
                                                                <source src="{{ url('storage/product_gallery/'.$gallery->file) }}"
                                                                        type="video/{{ $fileExtension }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                </div>
                            </div>
                        </div>
                        <!-- END: Product Image -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Product Rating -->
    <div class="flex items-center justify-center">
        <div style="width: 60rem">
            <div class="px-1 pb-3 intro-y box mt-7">
                <div class="flex items-center px-5 py-3 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mr-auto text-base font-medium">
                        Product Ratings
                    </h2>
                </div>
                <div class="flex flex-col lg:flex-row ">
                    <div class="mt-5 ">
                        <div class="flex items-center px-5">
                            <h1 class="text-5xl font-medium ">{{ number_format($ave_rate,2)}}</h1>
                            <h1 class="text-3xl font-medium ">/5</span>
                        </div>
                        <div class="flex items-center px-5">
                            <div class="star">
                                <div class="star-bg">
                                    @for($i=1; $i<6; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-2">
                            <div class="text-base text-slate-500">{{ $count_rate }} Ratings</div>
                        </div>
                    </div>

                    <div class="mt-5 ml-5 md:ml-10" >
                        <div class="star">
                            <div class="star-bg">
                                <div class="mt-1">
                                    @for($i=1; $i<6; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                    <div class="w-1/2 h-3 mt-3 progress md:hidden">
                                        <div class="progress-bar w-5/5" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @for($i=1; $i<5; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                    <div class="w-1/2 h-3 mt-3 progress md:hidden">
                                        <div class="w-4/5 progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @for($i=1; $i<4; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                    <div class="w-1/2 h-3 mt-3 progress md:hidden">
                                        <div class="w-3/5 progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @for($i=1; $i<3; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                    <div class="w-1/2 h-3 mt-3 progress md:hidden">
                                        <div class="w-2/5 progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mt-1">
                                    @for($i=1; $i<2; $i++)
                                        <i class="fa fa-star"> </i>
                                    @endfor
                                    <div class="w-1/2 h-3 mt-3 progress md:hidden">
                                        <div class="w-1/5 progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="flex-1 hidden mx-3 mt-5 md:flex">
                        <div class="w-1/2 h-3 mt-2 progress">
                            <div class="progress-bar @if($rate5 == 0) w-0 @else w-{{$rate5}}/{{ $count_rate }} @endif" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{$rate5}}</div>
                            <div class="h-3 mt-3 progress">
                                <div class="@if($rate4 == 0) w-0 @else w-{{$rate4}}/{{ $count_rate }} @endif progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{$rate4}}</div>
                            </div>
                            <div class="h-3 mt-3 progress ">
                                <div class="@if($rate3 == 0) w-0 @else w-{{$rate3}}/{{ $count_rate }} @endif progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{$rate3}}</div>
                            </div>
                            <div class="h-3 mt-3 progress ">
                                <div class="@if($rate2 == 0) w-0 @else w-{{$rate2}}/{{ $count_rate }} @endif progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{$rate2}}</div>
                            </div>
                            <div class="h-3 mt-3 progress ">
                                <div class=" @if($rate1 == 0) w-0 @else w-{{$rate1}}/{{ $count_rate }} @endif  progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{$rate1}}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Product Rating -->

    <!-- Begin Product Review -->
    <div class="flex items-center justify-center">
        <div class="px-1 pt-1 intro-y box mt-7 " style="width: 60rem">
            <div class="flex items-center px-5 py-5 border-b sm:py-3 border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Product Reviews
                </h2>
            </div>
            @forelse ($reviews as $rev)
                <div class="flex flex-col border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
                    <div class="mt-5 ">
                        <div class="flex items-center px-5">
                                <div class="star">
                                    <div class="star-bg">
                                        @for($x=0; $x<$rev->rate; $x++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        <div class="flex justify-start gap-2">
                            <div class="w-12 h-12 pt-3 pl-5 image-fit">
                                @if($rev->customer_photo != null)
                                    <img src="{{ url('storage/customer_profile_picture/'.$rev->customer_photo) }}" class="rounded-full"  alt="Missing Image">

                                @else
                                    <img class="rounded-full" src="{{ asset('dist/images/undraw_pic.svg') }}" alt=""  >

                                @endif
                            </div>
                            <div>
                                <div class="flex items-center px-5 pt-3">
                                    <div class="text-base"> {{ $rev->customer_name }} <span class="text-xs rounded-md text-primary">Verified Purchase</span></div>
                                </div>
                                <div class="flex items-center px-5">
                                    <div class="text-base text-slate-500">{{$rev->created_at->diffForHumans()  }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="text-base text-black">{{ $rev->comment }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="flex justify-center pt-5 pl-5 pr-5 font-medium text-slate-500">
                    <img class="max-h-24" src="{{ asset('dist/images/ReviewThumbsUp&Down.svg') }}" alt=""  >
                </div>
                <div class="flex justify-center pb-5 pl-5 pr-5 font-medium text-slate-500">
                    Let others know what do you think and be the first to write a review
                </div>
            @endforelse
            <div class="p-5">
                {!! $reviews->onEachSide(1)->links() !!}
            </div>
        </div>
    </div>
    <!-- END Product Review -->
    @push('scripts')
        <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var inputBox = document.getElementById("quantity");
        var invalidChars = [
            "e",
        ];

        inputBox.addEventListener("keydown", function(e) {
            if (invalidChars.includes(e.key)) {
            e.preventDefault();
            }
        });

        window.addEventListener('swal:modal',event =>{
            Swal.fire({
                title: event.detail.title,
                icon: event.detail.type
            })
        });
    </script>
    @endpush
    </div>
