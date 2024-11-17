<div class="top-bar-boxed border-b border-white/[0.08] -mt-7 md:mt-0 -mx-3 sm:-mx-8 md:mx-0 px-4 sm:px-8 md:px-6 mb-14 md:mb-8">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <div href="" class="-intro-x hidden md:flex w-auto">
            <img alt="{{ env('APP_NAME') }} Logo" class="w-12" src="{{asset('dist/images/MaliknetLogo.jpg')}}" data-action="zoom">
        </div>

        <!-- END: Logo -->
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item w-20 "><p>{{ env('APP_NAME') }}  </p></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
        <!-- BEGIN: Breadcrumb -->
        <nav class=" top-nav h-full mr-auto mt-2 w-1/2 sm:invisible xl:visible  ">
            <ul>
                <li>
                    <a href="{{ Route('home') }}" class="top-menu {{ (request()->is('/')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Home</div>
                    </a>
                </li>

                @if(!Auth::guard('customer')->check())
                <li>
                    <a href="{{Route('CLogin.index')}}" class="top-menu {{ (request()->is('CLogin')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Login</div>
                    </a>
                </li>
                <li>
                    <a href="{{Route('register.index')}}" class="top-menu {{ (request()->is('register')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Sign Up</div>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- END: Breadcrumb -->

       <!-- BEGIN: Search -->
        <div class="intro-x relative mr-3 sm:mr-6">
            <livewire:customer.productcatalog.search-product-form/>
        </div>
        <!-- END: Search -->

        @if(Auth::guard('customer')->check())
        <!-- BEGIN: Notifications -->
        <livewire:customer.component.carticon/>
        <!-- END: Notifications -->

        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            @if(!empty(Auth::guard('customer')->user()->photo))
                <img src="{{ url('storage/customer_profile_picture/'.Auth::guard('customer')->user()->photo) }}" class="rounded-full"  alt="Missing Image">
            @else
                <img alt="Missing Image" class="rounded-full" src="{{asset('dist/images/undraw_pic.svg')}}">
            @endif
            </div>
            <div class="dropdown-menu w-56 nt0">
                <ul class="dropdown-content bg-primary/70 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                    <li class="p-2">
                        <div class="font-medium">{{Auth::guard('customer')->user()->name}}  </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ Route('customer.profile') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Manage Account </a>
                    </li>
                    <li>
                        <a href="{{ Route('order.index') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> My Orders </a>
                    </li>
                    <li>
                        <a href="{{ Route('wishlist.index') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> My Wishlist </a>
                    </li>
                    <li>
                        <a href="{{ Route('reviews.index') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> My Reviews </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider border-white/[0.08]">
                    </li>
                    <li>
                        <a href="{{ Route('CLogout') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <!-- END: Account Menu -->
    </div>
</div>
