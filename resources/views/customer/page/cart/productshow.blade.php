@extends('customer.layout.base')
@section('title')
    {{ $product->name }}
@endsection

@section('content')
<!-- Begin: Product Information Show -->
@livewire('customer.productcatalog.product-show',['product' => $product])
<!-- End: Product Information Show -->
@endsection

