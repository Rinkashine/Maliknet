@extends('admin.layout.admin')
@section('content')
@section('title', 'Profile')
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('admin.component.profile-side')
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Profile Information
                </h2>
            </div>
            <div class="p-5">
                <livewire:admin.profile.user-info/>
            </div>
        </div>
        <!-- END: Display Information -->
    </div>
</div>
@endsection
