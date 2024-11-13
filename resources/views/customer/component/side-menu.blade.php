<nav class="top-nav xl:hidden">
    <ul>
        <li>
            <a href="{{ Route('home') }}" class="top-menu">
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
