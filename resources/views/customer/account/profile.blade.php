@extends('customer.layout.base')
@section('content')
@section('title', 'Profile Information')
<!-- Begin: Header -->
<!-- End: Header -->
<!-- Begin: Profile Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: Personal Information -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Personal Information
                </h2>
                <!-- Begin: If Customer Not Verify -->
                @if(!Auth::guard('customer')->user()->email_verified_at)
                    <div class="dropdown">
                        <a href="{{ Route('customer.verify') }}" class="leading-none text-slate-500">
                            Verify Account!
                        </a>
                    </div>
                @endif
                <!-- End: If Customer Not Verify -->
            </div>
            <div class="p-5">
                @if(session('fail'))
                    <div class="mb-2 alert alert-danger show intro-x" role="alert">{{ session('fail') }}</div>
                @endif
                <div class="flex flex-col xl:flex-row">
                    <!-- Begin: Show Customer Profile -->
                    <livewire:customer.auth.customer-profile/>
                    <!-- End: Show Customer Profile -->
                    <!-- Begin: Customer Change Profile Form -->
                    <livewire:customer.auth.customer-change-profile-form/>
                    <!-- End: Customer Change Profile Form -->
                    <!-- Begin: Customer Change Information-->
                    <livewire:customer.auth.customer-change-information/>
                    <!-- End: Customer Change Information -->
                    <!-- Begin: Customer Change Password Modal -->
                    <livewire:customer.auth.customer-set-password-form/>
                    <!-- End: Customer Change Password Modal -->
                    <div class="mx-auto w-52 xl:mr-0 xl:ml-6">
                        <div class="p-5 border-2 border-dashed rounded-md shadow-sm border-slate-200/60 dark:border-darkmode-400">
                            <div class="">
                                @if(!empty(Auth::guard('customer')->user()->photo))
                                    <img src="{{ url('storage/customer_profile_picture/'.Auth::guard('customer')->user()->photo.'') }}" class="object-fill w-full h-40 rounded-md"  alt="Missing Image" data-action="zoom">
                                @else
                                    <img alt="Missing Image" class="rounded-md" src="{{asset('dist/images/undraw_pic.svg')}}" data-action="zoom">
                                @endif
                            </div>
                            <div class="relative mx-auto mt-5 cursor-pointer">
                                <button class="w-full btn btn-primary" data-tw-toggle="modal" data-tw-target="#change-profile-modal">
                                    Change Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Personal Information -->
        <!-- BEGIN: RECENT ORDERS -->
        <div class="mt-5 intro-y box">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="mr-auto text-base font-medium">
                    Recent Orders
                </h2>
            </div>
            <div class="p-5">
                <livewire:customer.auth.customer-recent-orders-table/>
            </div>
        </div>
            <!-- END: RECENT ORDERS -->
    </div>
    <!-- END: Personal Information -->
</div>
<!-- End: Profile Body -->
@endsection
@push('scripts')
<script>
 const myModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-modal"));
    //Hide Form Modal
    window.addEventListener('CloseModal',event => {
        myModal.hide();
    });
    //Closing Modal and Refreshing its value
    const myModalEl = document.getElementById('change-profile-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });




    const informationModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-information-modal"));
    window.addEventListener('openEditInformationModal',event => {
        informationModal.show();
    });

    //Hide Form Modal
    window.addEventListener('CloseInformationModal',event => {
        informationModal.hide();
    });
    //Closing Modal and Refreshing its value
    const infoModal = document.getElementById('change-profile-information-modal')
    infoModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('ForceClose');
    });


    const setPassword = tailwind.Modal.getInstance(document.querySelector("#set-password-modal"));

    window.addEventListener('openSetPasswordModal',event => {
        setPassword.show();
    });
    window.addEventListener('CloseSetPasswordModal',event => {
        setPassword.hide();
    });
</script>
@endpush
