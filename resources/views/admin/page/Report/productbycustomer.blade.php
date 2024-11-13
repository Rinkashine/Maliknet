@extends('admin.layout.admin')
@section('content')
@section('title', 'Product By Customer Ranking')

{{-- <livewire:report.product-by-customer/> --}}
@livewire('report.product-by-customer',[
    'name' => $name,
    'id' => $id
    ])

@endsection
