@extends('admin.layout.admin')
@section('content')
@section('title', 'Create Transfer')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Create Inventory Transfer
         </h2>
    </div>
</div>
<!-- End: Header -->
<!-- Begin: Inventory Transfer Form -->
<livewire:admin.transfer.inventory-transfer-form/>
<!-- End: Inventory Transfer Form -->
@endsection
@push('scripts')
<script>
    const onInput = (element,id, index)=>{
        livewire.emit('Prod',element.value,id,index);
    }
</script>

@endpush
