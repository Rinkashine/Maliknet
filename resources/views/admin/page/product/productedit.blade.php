@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit Product')
<div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> {{ $product->name }}
            @if($product->status == 1)
                <span class="ml-2 px-2 py-0.5 bg-slate-100 text-success btn btn-success text-xs rounded-md">Active</span>
            @else
                <span class="ml-2 p-5 py-0.5 mb-5 bg-slate-100 text-danger btn btn-danger text-xs rounded-md">Inactive</span>
            @endif
        </h2>
    </div>
<!-- Begin Product Edit Form -->
@livewire('admin.product.product-edit-form',['product' => $product])
<!-- End: Product Edit Form -->
<!-- Begin: Delete Product Image Modal -->
<livewire:admin.product.delete-product-image/>
<!-- End: Delete Product Image Moda -->
<!-- Begin: Success Session Notifaction -->
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
<!-- End: Success Session Notification -->
<!-- Begin: Invalid Notification -->
<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Invalid Notification -->
@push('scripts')

<script>
    //SuccessAlert
    window.addEventListener('SuccessAlert',event => {
        let id = (Math.random() + 1).toString(36).substring(7);
        console.log(event)
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
        //
        window.addEventListener('Scrollup',event => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            console.log('s')
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
    const ImageDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        ImageDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        ImageDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
</script>
@endpush
@endsection
