@extends('admin.layout.admin')
@section('content')
@section('title', 'Receive Transfer')
<!-- Begin: Header -->
<div class="intro-y items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Receive Items: # {{ $orderinfo->id }}
    </h2>
<div>

    @livewire('admin.transfer.receive-transfer-form',['orderinfo' => $orderinfo])

@endsection


