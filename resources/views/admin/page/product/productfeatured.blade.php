@extends('admin.layout.admin')
@section('content')
@section('title', 'Featured Product')
<!-- Begin: Header -->

<!-- End: Header -->
<livewire:admin.product.featured-product-table/>

@endsection
@push('scripts')
<script>

</script>
@endpush
