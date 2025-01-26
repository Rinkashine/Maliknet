<div>
    @forelse ($categories as $category)
    <div>
        <p class="text-2xl italic font-normal text-center border-b-2 border-slate-300 text-bookmark-grey lg:text-left">
            {{ $category->name }}
        </p>
    </div>
    <div class="my-5 pb-5 pl-2 pr-2">
        <div class="col-span-12">
            <!-- BEGIN: Product List -->
            <div class="intro-y lg:mt-5">
                <div class="grid grid-cols-12 gap-4 mt-2">
                    <!-- Begin: Display Products -->
                    @foreach ($category->categoryTransactions as $product)
                        <div class="intro-y col-span-6 sm:col-span-5 md:col-span-4 lg:cols-span-3 2xl:col-span-2  w-full">
                            <a href="{{ Route('productshow', $product) }}">
                                <div class="box w-full">
                                    <div class="px-2 pt-2">
                                        <p class="text-right text-slate-500 text-xs mt-0.5">
                                            {{ $product->category->name }}
                                        </p>
                                    </div>
                                    <div class="w-full flex justify-center border-t border-slate-200/60 dark:border-darkmode-400 mt-2"> </div>
                                    <div class="p-5">
                                        <div class="h-48">
                                            @if(count($product->images) == 0)
                                                <img alt="Missing Image" class="object-cover h-full rounded-md w-full" src="{{ asset('dist/images/MaliknetLogo.jpg') }}" onerror="this.onerror=null;this.src='{{ asset('dist/images/ImageNotFound.png') }}'">
                                            @else
                                                @foreach ($product->images->take(1)  as $model)
                                                    @if (Storage::disk('public')->exists('product_photos/'.$model->images))
                                                        <img alt="Missing Image" class="object-cover h-full rounded-md w-full" src="{{ url('storage/product_photos/'.$model->images) }}">
                                                    @else
                                                        <img alt="Missing Image" class="object-cover h-full rounded-md w-full" src="{{  asset('dist/images/ImageNotFound.png') }}" >
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="font-medium truncate ">{{ $product->name }} </div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="mr-auto"> Price: <span class="">₱{{ number_format($product->price,2) }}</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
    @empty

    @endforelse


</div>
