<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <div class="flex mr-auto">
            <img alt="Go Dental Logo" class="w-12" src="{{asset('dist/images/MainLogo.png')}}" data-action="zoom">
        </div>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        <li>
            <a href="{{ route('dashboard.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-house p-1 fa-lg"></i></div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        @if (Auth::guard('web')->user()->can('brand_access') || Auth::guard('web')->user()->can('category_access'))
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"><i class="fa-solid fa-truck-ramp-box fa-lg p-1"></i> </div>
                <div class="menu__title">Product Attribute <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
            </a>
            <ul class="">
                @can('brand_access')
                <li>
                    <a href="{{Route('brand.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-b p-1 fa-lg"></i></div>
                        <div class="menu__title"> Brand </div>
                    </a>
                </li>
                @endcan
                @can('category_access')
                <li>
                    <a href="{{Route('category.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-c p-1 fa-lg"></i> </div>
                        <div class="menu__title"> Category </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        @if (Auth::guard('web')->user()->can('product_create') || Auth::guard('web')->user()->can('product_access') || Auth::guard('web')->user()->can('inventory_access'))
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"><i class="fa-brands fa-product-hunt  fa-lg p-1"></i> </div>
                <div class="menu__title">Product <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
            </a>
            <ul class="">
                @can('product_access')
                <li>
                    <a href="{{Route('product.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-p fa-lg p-1"></i> </div>
                        <div class="menu__title"> Product </div>
                    </a>
                </li>
                @endcan
                @can('inventory_access')
                <li>
                    <a href="{{Route('inventory.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-warehouse fa-lg p-1"></i> </div>
                        <div class="menu__title"> Inventory </div>
                    </a>
                </li>
                @endcan
                @can('inventory_transfer_access')
                <li>
                    <a href="{{Route('transfer.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-shuffle mr-1 fa-lg p-1"></i> </div>
                        <div class="menu__title">  Purchase Order </div>
                    </a>
                </li>

                @endcan
                @can('product_edit')
                    <li>
                        <a href="{{Route('product.FeaturedProduct')}}" class="menu">
                            <div class="menu__icon">  <i class="fa-solid fa-bookmark mr-1 fa-lg p-1"></i> </div>
                            <div class="menu__title">   Featured Products</div>
                        </a>
                    </li>
                @endcan
                @can('product_create')
                <li>
                    <a href="{{Route('product.create')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-plus mr-1 fa-lg p-1"></i> </div>
                        <div class="menu__title"> Add New Product </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        @can('supplier_access')
        <li>
            <a href="{{ route('supplier.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-boxes-packing p-1 fa-lg"></i></div>
                <div class="menu__title"> Supplier </div>
            </a>
        </li>
        @endcan

        @can('order_access')
        <li>
            <a href="{{Route('orders.index')}}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-cart-plus fa-lg p-1"></i></div>
                <div class="menu__title"> Orders </div>
            </a>
        </li>
        @endcan

        @can('post_access')
        <li>
            <a href="{{Route('banner.index')}}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-signs-post fa-lg p-1"></i> </div>
                <div class="menu__title"> Home Banner </div>
            </a>
        </li>
        @endcan

        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create') || Auth::guard('web')->user()->can('customer_access'))
            <li class="menu__devider my-6"></li>
        @endif
        @can('customer_access')
        <li>
            <a href="{{Route('customer.index')}}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-user-doctor fa-lg p-1"></i> </div>
                <div class="menu__title"> Customers </div>
            </a>
        </li>
        @endcan
        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create'))
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-users-gear fa-lg p-1"></i> </div>
                <div class="menu__title"> Users <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
            </a>
            <ul class="">
                @can('user_management_access')

                @endcan
                <li>
                    <a href="{{Route('user.index')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-user fa-lg p-1"></i></div>
                        <div class="menu__title"> Users </div>
                    </a>
                </li>
                @can('role_access')
                <li>
                    <a href="{{Route('role.index')}}" class="menu">
                        <div class="menu__icon">  <i class="fa-solid fa-r fa-lg p-1"></i> </div>
                        <div class="menu__title"> Roles </div>
                    </a>
                </li>
                @endcan
                @can('user_create')
                <li>
                    <a href="{{Route('user.create')}}" class="menu">
                        <div class="menu__icon"> <i class="fa-solid fa-plus mr-1 fa-lg p-1"></i> </div>
                        <div class="menu__title"> Add New User </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endif
        @if (Auth::guard('web')->user()->can('report_access'))
        <!--Divider-->
        <li class="menu__devider my-6"></li>
        @endif
        @can('report_access')
         <!--Reports-->
        <li>
            <a href="{{Route('report.index')}}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-chart-pie fa-lg p-1"></i> </div>
                <div class="menu__title"> Reports </div>
            </a>
        </li>
        @endcan
    </ul>
</div>
