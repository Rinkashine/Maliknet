<nav class="side-nav">
    <div class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="{{ env('APP_NAME') }}" class="w-10" src="{{asset('dist/images/MaliknetLogo.jpg')}}" data-action="zoom">
        <span class="hidden xl:block text-white text-lg ml-3"> {{ env('APP_NAME') }}  </span>
    </div>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <!--Dashboard-->
        <li>
            <a href="{{ route('dashboard.index') }}" class="side-menu {{ (request()->is('admin/dashboard')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-house p-1 fa-lg"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <!--Product Attribute-->
        @if (Auth::guard('web')->user()->can('category_access'))
        @can('category_access')
            <li>
                <a href="{{ route('category.index') }}" class="side-menu {{ (request()->is('admin/category'))  ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"> <i class="fa-solid fa-truck-ramp-box p-1 fa-lg"></i> </div>
                    <div class="side-menu__title"> Category </div>
                </a>
            </li>
        @endcan

        @endif
        <!--Product-->
        @if (Auth::guard('web')->user()->can('product_access'))
            <li>
                <a href="{{ route('product.index') }}" class="side-menu {{ (request()->is('admin/product'))  ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"> <i class="fa-solid fa-boxes-packing p-1 fa-lg"></i> </div>
                    <div class="side-menu__title"> Product </div>
                </a>
            </li>
        @endif

        <!--Orders-->
        @can('order_access')
        <li>
            <a href="{{Route('orders.index')}}" class="side-menu {{ (request()->is('admin/orders')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-cart-plus fa-lg p-1"></i> </div>
                <div class="side-menu__title"> Orders </div>
            </a>
        </li>
        @endcan


        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create') || Auth::guard('web')->user()->can('customer_access'))
        <!--Divider-->
        <li class="side-nav__devider my-6"></li>
        @endif
        <!--Customers-->
        @can('customer_access')
        <li>
            <a href="{{Route('customer.index')}}" class="side-menu {{ (request()->is('admin/customer')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-user-doctor fa-lg p-1"></i> </div>
                <div class="side-menu__title"> Customers </div>
            </a>
        </li>
        @endcan
        <!--Users-->
        <!--Roles-->
        @if (Auth::guard('web')->user()->can('user_management_access') || Auth::guard('web')->user()->can('role_access') || Auth::guard('web')->user()->can('user_create'))
        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('admin/role')) || (request()->is('admin/permission')) || (request()->is('admin/user')) ?  'side-menu--active ' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-users-gear fa-lg p-1"></i> </div>
                <div class="side-menu__title">
                    Users
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                @can('user_management_access')
                    <li>
                        <a href="{{Route('user.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i class="fa-solid fa-user fa-lg p-1"></i> </div>
                            <div class="side-menu__title">Users</div>
                        </a>
                    </li>
                @endcan
                @can('role_access')
                    <li>
                        <a href="{{Route('role.index')}}" class="side-menu">
                            <div class="side-menu__icon"> <i class="fa-solid fa-r fa-lg p-1"></i> </div>
                            <div class="side-menu__title">Role</div>
                        </a>
                    </li>
                @endcan
                @can('user_create')
                    <li>
                        <a href="{{Route('user.create')}}" class="side-menu">
                            <div class="side-menu__icon">  <i class="fa-solid fa-plus mr-1 fa-lg p-1"></i>  </div>
                            <div class="side-menu__title">Add New User</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        @endif
        @if (Auth::guard('web')->user()->can('report_access'))
        <!--Divider-->
        <li class="side-nav__devider my-6"></li>
        @endif
        @can('report_access')
            <!--Reports-->
            <li>
                <a href="{{Route('report.index')}}" class="side-menu {{ (request()->is('admin/report')) ? 'side-menu--active' : '' }}">
                    <div class="side-menu__icon"> <i class="fa-solid fa-chart-pie fa-lg p-1"></i> </div>
                    <div class="side-menu__title"> Reports </div>
                </a>
            </li>
        @endcan
    </ul>
</nav>
