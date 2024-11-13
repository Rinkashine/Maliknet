@extends('admin.layout.admin')
@section('content')
@section('title', 'Inventory History')

@livewire('admin.inventory.product-inventory-history',['product' => $product])

@endsection
