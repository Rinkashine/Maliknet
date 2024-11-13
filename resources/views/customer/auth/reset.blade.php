@extends('customer.layout.base')
@section('content')
@section('title', 'Reset Password')
<!-- Begin: Reset Body -->
<div class="intro-y items-center justify-center flex">
    <div class="bg-white my-10" style="width: 30rem">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                Reset Password
            </h2>
        </div>
        @if (session('success'))
            <div class="p-5" >
                <div class="flex justify-center">
                    <i class="fa-regular fa-paper-plane fa-5x "></i>
                </div>
                <center>
                    <div >{{ session('success') }}</div>
                </center>
                <a href="{{ Route('CLogin.index') }}" class="btn btn-primary w-full mt-2 mb-2">Ok</a>
            </div>
        @endif

        <div id="vertical-form" class="p-5 @if(session('success'))hidden @endif">
            <form action="{{Route('resetcustomer.store')}}" method="POST">
                @csrf
                @if(session('success'))
                <div class="alert alert-success show mb-5 form-control" role="alert">{{session('success')}}</div>
                @endif

                <div class="preview">
                    <div>
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="example@gmail.com">
                        @error('email')
                            <div class="login__input-error text-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-5 w-full "  @if(session('success')) disabled @endif>Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Begin: Reset Body -->
@endsection

