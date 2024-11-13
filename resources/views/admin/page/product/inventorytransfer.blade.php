@extends('admin.layout.admin')
@section('content')
@section('title', 'Purchase Order')


<!-- Begin: Inventory Transfer  -->
<livewire:admin.transfer.inventory-transfer-table/>
<!-- End: Inventory Transfer  -->

@endsection

@push('scripts')
@endpush
