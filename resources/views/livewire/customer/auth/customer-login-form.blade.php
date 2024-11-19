
<div class="container w-full flex flex-col lg:flex-row items-center py-5 mt-10 px-5">
    <!-- Image -->
    <div class="intro-y flex justify-center flex-1 z-10  hidden  sm:hidden md:hidden lg:hidden xl:block 2xl:block	">
        <img  src="{{ asset('dist/images/login.svg') }}" alt="{{ env('APP_NAME') }} Login Image" />
    </div>
    <!-- Content -->
    <div class="items-center justify-center flex flex-1 w-full ">
        <div class="box  ">
            <div class="p-5 border-b-2 border-slate-100 ">
                <h2 class="intro-x text-2xl sm:text-xl font-medium  text-center mr-auto ">
                    Welcome to {{ env('APP_NAME') }} Please Login
                </h2>
            </div>
            <div class="p-5">
                <form wire:submit.prevent="login">
                    @csrf
                    @if(session('fail'))
                        <div class="alert alert-danger show flex items-center mb-2" role="alert">
                            <i class="fa-solid  fa-2x fa-circle-exclamation mr-2"></i> {{ session('fail') }}
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="intro-x alert alert-dark show mb-2 mt-2" role="alert">{{session('info')}}</div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-primary show mb-2" role="alert">{{session('status')}}</div>
                    @endif

                    <div class=" text-base ">
                        <div class="intro-x ">
                            <label class="form-label">Email</label>
                            <input type="email" wire:model.lazy="email" class="form-control @error('email') border-danger @enderror" placeholder="example@gmail.com" >
                            <div class="text-danger mt-2">@error('email'){{$message}}@enderror</div>
                        </div>
                        <div class="mt-3 intro-x">
                            <label class="form-label">Password</label>
                            <input type="password" wire:model.lazy="password" class="form-control" placeholder="password">
                        </div>
                        <div class="intro-x flex text-slate-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" wire:model.lazy="remember" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="{{ Route('resetcustomer.index') }}" class="text-slate-400" >Forgot Password?</a>
                        </div>
                        <div wire:ignore class="intro-x">
                            <button type="submit" class="btn btn-primary mt-5 w-full"
                            data-callback='handle'
                            data-action='login' >Login</button>
                        </div>

                        <div class="intro-x  mt-5 items-center grid grid-cols-3">
                            <hr class="border-gray-400">
                            <p class="text-slate-400 text-center">Or, sign with</p>
                            <hr class="border-gray-400">
                        </div>
                        <div class="intro-x text-slate-600 text-xs sm:text-sm items-center justify-center flex flex-1 gap-5">
                           <!--
                            <a href="/auth/github/redirect" class="btn mt-5 w-full" ><i class="fa-brands fa-github fa-xl mr-1" style="color: #054232; "></i>Github</a>
                            -->
                            <a href="/auth/google/redirect" class="btn mt-5 w-full" ><i class="fa-brands fa-google fa-xl mr-1" style="color: #054232; "></i>Google</a>

                        </div>
                        <div class="pt-5 text-center intro-x " >
                            <a class="text-primary font-normal" href="{{Route('register.index')}}">New to {{ env('APP_NAME') }} Click here.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
