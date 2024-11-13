<div class="sm:p-3">

    <!-- Begin: Table Mobile -->
    <div class="block sm:hidden intro-y">
        @forelse ($wishlists as $wishlist)
            <div class="grid grid-cols-5 mt-2 text-xs border rounded-lg">
                <div class="col-span-2 p-2 rounded-l-lg bg-slate-50">
                    <div class="grid gap-1 text-center">
                        <div>Product Name</div>
                        <div>Date</div>
                    </div>
                </div>
                <div class="col-span-3 p-2">
                    <div class="grid gap-1">
                        <div class="overflow-x-auto"><div class="w-64"><a  href="{{ Route('productshow', $wishlist->product_id)  }}">{{ $wishlist->product->name }}</a></div></div>
                        <div class="border-b">{{ $wishlist->created_at }}</div>
                        <div class="text-danger">
                            <button type="submit" wire:click="RemoveProduct({{$wishlist->id}})">
                                <i class="fa-regular fa-trash-can"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        <div class="px-5 py-5 text-lg bg-gradient-to-r from-slate-50 via-white to-slate-100">
            <img alt="Wishlist" class="block object-scale-down w-full mt-3 max-h-24 sm:hidden" src="{{ asset('dist/images/WishlistMobile.svg') }}">
            <p class="text-center sm:text-3xl bold">Make your favorites easily remembered!</p>
        </div>
        @endforelse
    </div>
    <!-- End: Table Mobile -->


    <div class="hidden sm:block intro-y">
        <div class="overflow-x-auto">
            <table class="table rounded table-fixed bg-slate-50 table-bordered">
                <thead class="bg-white">
                    <tr>
                        <th class="whitespace-nowrap">Product Name</th>
                        <th class="text-center whitespace-nowrap">Date</th>
                        <th class="text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($wishlists as $wishlist)
                    <tr>
                        <td class="whitespace-nowrap"><a href="{{ Route('productshow', $wishlist->product_id)  }}">{{ $wishlist->product->name }}</a></td>
                        <td class="text-center whitespace-nowrap">{{ $wishlist->created_at }}</td>
                        <td class="text-center whitespace-nowrap text-danger">
                            <button type="submit" wire:click="RemoveProduct({{$wishlist->id}})">
                                <i class="fa-regular fa-trash-can"></i>
                                Remove
                            </button>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center whitespace-nowrap">
                                <div class="px-5 py-5 text-lg bg-gradient-to-r from-slate-50 via-white to-slate-100">
                                    <p class="text-center sm:text-3xl bold">Make your favorites easily remembered!</p>
                                    <img alt="Wishlist" class="hidden object-scale-down w-full mt-3 sm:block max-h-96" src="{{ asset('dist/images/Wishlist.svg') }}">
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
