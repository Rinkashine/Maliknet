@extends('customer.layout.base')
@section('content')
@section('title', 'Home')
<!-- Begin: Main Container -->
<div class="container mt-5">
    <!-- Begin: Product List -->
    <livewire:customer.productcatalog.product-catalog-table/>
    <!-- End: Product List -->
</div>
<!-- End: Main Container -->
@endsection
