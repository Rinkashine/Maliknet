@extends('admin.layout.admin')
@section('content')
@section('title', 'Customer Bought Products')

@livewire('report.customer-by-product',[
    'name' => $name,
    'id' => $id
    ])

@endsection
