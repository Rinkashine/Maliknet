<div >
    @if(Auth::guard('customer')->check())
        @if($wishlist_checker == 0)
            <form wire:submit.prevent="AddToWishlist">
                <button type="submit" class="text-success" wire:loading.attr="disabled" >
                    <i class="fa-2x fa-regular fa-heart"></i>
                </button>
            </form>
        @else
            <form wire:submit.prevent="RemoveToWishlist">
                <button type="submit"  class="text-success" wire:loading.attr="disabled">
                    <i class="fa-2x fa-solid fa-heart"></i>
                </button>
            </form>
        @endif
    @else
        <div class="text-success">
            <i class="fa-2x fa-solid fa-heart"></i>
        </div>
    @endif
</div>
