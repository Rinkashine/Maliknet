<div>
    <div class="search hidden sm:block">
        <input type="search" wire:focus="handleFocus" wire:blur="handleBlur"  wire:model="query" wire:keydown.enter="SearchProduct" class="search__input form-control border-transparent" placeholder="Search...">
    </div>
    @if(!empty($query) && $hasfocus)
        <div class="search-result">
            <div class="search-result__content">
                @if(count($products) != 0 ** $hasfocus)
                    <div class="search-result__content__title">List of Products</div>
                     @foreach($products as $product)
                        <a href="{{ Route('productshow',$product->id) }}" class="flex items-center h-full p-1">
                            <div class="w-8 h-8  text-success flex items-center justify-center rounded-full">
                                @if(count($product->images) == 0)
                                    <img src="{{ asset('dist/images/logo.png') }}"  class="rounded-full" alt="">
                                @else
                                    @foreach ($product->images->take(1)  as $model)
                                        <img alt="Missing Image" class="rounded-full"  src="{{ url('storage/product_photos/'.$model->images) }}">
                                    @endforeach
                                @endif
                            </div>
                            <div class="ml-3 truncate w-full">{{ $product->name }}</div>
                        </a>
                     @endforeach
               @else
                <a href="" class="flex items-center">
                    <div class="ml-3 truncate ">No Products Found For <strong>{{ $query }}</strong></div>
                </a>
               @endif
            </div>
        </div>
    @endif
</div>
