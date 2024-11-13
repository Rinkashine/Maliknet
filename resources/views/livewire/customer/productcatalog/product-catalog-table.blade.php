<div>
    <div class="grid grid-cols-12 gap-5 lg:gap-5 2xl:gap-5">
        <!-- BEGIN: Product Filter -->
        <div class="col-span-12 lg:col-span-3 2xl:col-span-2 flex lg:block flex-col-reverse">
            <div class="sticky top-10 right-10 box mt-5">
                <div class="relative flex items-center p-5">
                    <div class="ml-4 mr-auto">
                        <div class="font-medium text-base">Product Filters</div>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <input type="search" wire:model.lazy="search" class="form-control" name="Search" placeholder="Search Product">
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base p-2">Filter By Category:</div>
                    <div>
                        <select wire:model="filterbycategory" class="form-select w-full" name="category">
                            <option value="">No Filter</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    <div class="font-medium text-base p-2">Filter By Brand:</div>
                    <div>
                        <select wire:model="filterbybrand" class="form-select w-full" name="category">
                            <option value="">No Filter</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Product Filter sticky top-0 right-10 w-full flex justify-end -->
        <div class="col-span-12 lg:col-span-9 2xl:col-span-10">
            <!-- BEGIN: Product List -->
            <div class="intro-y lg:mt-5">
                <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="mb-5 font-medium text-base ">
                        List of Products
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-4 mt-2">
                    <!-- Begin: Display Products -->


                    @forelse ($products as $product)
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
                                        <div class="h-full">
                                            @if(count($product->images) == 0)
                                                <img alt="Missing Image" class="object-contain h-full rounded-md w-full" src="{{ asset('dist/images/logo.png') }}" onerror="this.onerror=null;this.src='{{ asset('dist/images/ImageNotFound.png') }}'">
                                            @else
                                                @foreach ($product->images->take(1)  as $model)
                                                    @if (Storage::disk('public')->exists('product_photos/'.$model->images))
                                                        <img alt="Missing Image" class="object-contain h-full rounded-md w-full" src="{{ url('storage/product_photos/'.$model->images) }}">
                                                    @else
                                                        <img alt="Missing Image" class="object-contain h-full rounded-md w-full" src="{{  asset('dist/images/ImageNotFound.png') }}" >
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="font-medium truncate ">{{ $product->name }}</div>
                                    </div>
                                    <div class="px-2 pt-3 pb-2 border-t border-slate-200/60 dark:border-darkmode-400">
                                        <div class="flex w-full text-xs text-slate-500">
                                            <div class="mr-auto"> Price: <span class="">₱{{ number_format($product->sprice,2) }}</span> </div>
                                            <div class="text-xs">{{$product->brand->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-12">
                            <h2 class="intro-y text-lg font-medium mt-10">
                                <div class="flex justify-center flex-col">
                                    <img alt="Missing Image" class="object-fill rounded-md h-48 " src="{{ asset('dist/images/NoResultFound.svg') }}">
                                    <div class="flex justify-center">No Product Found <strong class="ml-1"> {{ $search }}</strong>  </div>
                                </div>
                            </h2>
                        </div>
                    @endforelse
                    <!-- End: Display Products -->
                </div>
                @if($perPage <= $products->count())
                    <div class="intro-y flex justify-center items-center mt-5">
                        <a wire:click="load" class="btn btn-primary">Load More</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
