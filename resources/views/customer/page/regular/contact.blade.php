@extends('customer.layout.base')
@section('content')
@section('title', 'Contact Us')

<div class="items-center justify-center flex" >
    <div class="intro-y box py-10 sm:py-10 mt-5" style="width: 54rem">
        <div class="px-1 mt-0">
            <div class="font-medium text-center text-2xl">Contact Us</div>
        </div>
            <livewire:customer.contactform.contact-form/>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<style>
    .swal-button {
    padding: 7px 19px;
    border-radius: 2px;
    background-color: #054232;
    font-size: 12px;
    border: 1px solid #054232;
    text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.3);
    }
</style>
@endpush
