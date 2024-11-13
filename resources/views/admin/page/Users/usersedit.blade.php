@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit User')


<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Supplier  -->
    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Editing User - {{ $user->name }}
            </h2>
        </div>
        <!-- Begin: Users Form -->
        @livewire('admin.user.user-edit-form',['user' => $user ])
        <!-- End: Uses Form -->
    </div>
</div>
@endsection
