@extends('admin.layout.admin')
@section('content')
@section('title', 'Add Product')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Add Product
    </h2>
</div>
<!-- Begin: Add Product Form -->
<livewire:admin.product.product-add-form/>
<!-- End: Add Product Form -->
@endsection
@push('scripts')
<script>
    var inputBoxprice = document.getElementById("product-price");
        var invalidChars = [
          "e",
        ];

        inputBoxprice.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });
    var inputBoxcprice = document.getElementById("product-cprice");
        var invalidChars = [
          "e",
        ];

        inputBoxcprice.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });
    var inputBoxstock = document.getElementById("product-stock");
        var invalidChars = [
          "e",
        ];

        inputBoxstock.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });
    var inputBoxwstock = document.getElementById("product-wstock");
        var invalidChars = [
          "e",
        ];

        inputBoxwstock.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });
    var inputBoxweight = document.getElementById("weight");
        var invalidChars = [
          "e",
        ];

        inputBoxweight.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });
</script>
@endpush



