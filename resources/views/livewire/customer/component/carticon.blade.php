<div>
    <a href="{{ Route('cart.index') }}">
        <div class="intro-x dropdown mr-4 sm:mr-6">
            <div  class="notification notification--light cursor-pointer @if($cart_count != 0) notification--bullet @endif" role="button" aria-expanded="false">
                <i class="fa-solid fa-cart-plus fa-lg"></i>
            </div>
        </div>
    </a>
</div>
