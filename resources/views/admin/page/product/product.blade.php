@extends('admin.layout.admin')
@section('content')
@section('title', 'Product')
<!-- Begin:Header -->
<div class="intro-y flex justify-between  items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            Product List
         </h2>
    </div>
    @can('product_create')
    <div>
        <a href="{{ Route('product.create') }}" class="btn btn-primary">Create Product</a>
    </div>
    @endcan
</div>
<!-- End: Header -->

<!-- Begin: Product Table-->
<livewire:admin.product.product-table/>
<!-- End: Product Table -->

<!-- Begin: Delete Product Modal -->
<livewire:admin.product.delete-product/>
<!-- End: Delete Product Modal-->

<!-- Begin: Success Session Notification -->
@if(session('success'))
<div id="edit-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Product Added Successfully</div>
        <div class="text-slate-500 mt-1">{{session('success')}}</div>
    </div>
</div>

<script>
Toastify({
    node: $("#edit-success-notification-content") .clone() .removeClass("hidden")[0],
    duration: 7000,
    newWindow: true,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true, }).showToast();
</script>
@endif

@if(session('ProductEditSuccess'))
    <div id="edit-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
        <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Edit Success</div>
            <div class="text-slate-500 mt-1">{{session('ProductEditSuccess')}}</div>
        </div>
    </div>
    <script>
    Toastify({
        node: $("#edit-success-notification-content") .clone() .removeClass("hidden")[0],
        duration: 7000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true, }).showToast();
    </script>
@endif
<!-- End: Success Session Notification -->

<!-- Begin: Success Notification -->
<div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Success Notification -->
<!-- Begin: Invalid Notification -->
<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Invalid Notification -->
@endsection

@push('scripts')
<script>
    //SuccessAlert
    window.addEventListener('SuccessAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            className: `toast-${id}`,
            newWindow: false,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
            toast.querySelector("#title").innerText = event.detail.title
            toast.querySelector("#message").innerText = event.detail.name
        });

    //Invalid Alert
    window.addEventListener('InvalidAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        Toastify({
            node: $("#invalid-success-notification-content") .clone() .removeClass("hidden")[0],
            duration: 7000,
            newWindow: true,
            className: `toast-${id}`,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true, }).showToast();

            const toast = document.querySelector(`.toast-${id}`)
                toast.querySelector("#title").innerText = event.detail.title
                toast.querySelector("#message").innerText = event.detail.name
    });

    //Delete Modal
    const ProductDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        ProductDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        ProductDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
</script>
@endpush
