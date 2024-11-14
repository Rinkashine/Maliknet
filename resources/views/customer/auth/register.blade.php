@extends('customer.layout.base')
@section('content')
@section('title', 'Register')
<!--Begin: Customer Register Body -->
<div class="items-center justify-center flex">
    <div class="" style="width: 54rem">
        <div class="flex intro-y items-center py-10 sm:py-3 mt-5">
            <div class="flex items-center mr-auto">
                <h2>Create your Go {{ env('APP_NAME') }} Account</h2>
            </div>
            <a class="text-success" href="{{ Route('CLogin.index') }}">Already have an account? Login here</a>
        </div>
    </div>
</div>
<!-- BEGIN: Registration Layout -->
<livewire:customer.auth.customer-register/>
<!-- END: Registration Layout -->
<!--End: Customer Register Body -->
@endsection

