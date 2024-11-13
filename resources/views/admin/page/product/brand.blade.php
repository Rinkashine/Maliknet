@extends('admin.layout.admin')
@section('content')
@section('title', 'Brand')
<!-- Begin: Header -->
<div class="intro-y flex justify-between space-between mt-10">
    <div>
        <h2 class="text-lg font-medium ">Brand</h2>
    </div>
    @can('brand_export')
        <div>
            <a href="{{Route('exportbrandpdf')}}" class="btn btn-primary">Export</a>
        </div>
    @endcan
</div>
<!-- End: Header -->


<!-- Begin: Brand Table -->
<livewire:admin.brand.brand-table/>
<!-- End: Brand Table -->
<!-- Begin: Delete Brand Modal -->
<livewire:admin.brand.delete-brand/>
<!-- End: Delete Brand Modal -->
<!-- Begin: Brand Form Modal -->
<livewire:admin.brand.brand-form/>
<!-- End: Brand Form Modal -->
<!-- Begin: Brand Edit Form Modal -->
<livewire:admin.brand.brand-edit-form/>
<!-- End: Brand Edit Form Modal -->
<!-- Begin: Change Photo Form Modal -->
<livewire:admin.brand.brand-change-photo-form/>
<!-- End: Change Photo Form Modal -->


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
    //Add Form Modal
    const addItemModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    //Hide Add Form Modal
    window.addEventListener('CloseAddItemModal',event => {
        addItemModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseaddItemModal = document.getElementById('add-item-modal')
    ForceCloseaddItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });

    //Show Edit Form Modal
    const editItemModal = tailwind.Modal.getInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('OpenEditModal',event => {
        editItemModal.show();
    });
    //Hide Add Form Modal
    window.addEventListener('closeEditModal',event => {
        editItemModal.hide();

    });
    //Closing Modal and Refreshing its value
    const ForceCloseEditItemModal = document.getElementById('edit-item-modal')
    ForceCloseEditItemModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseEditModal');
    });

     //Show Form Modal
    const ChangePhotoModal = tailwind.Modal.getInstance(document.querySelector("#change-item-modal"));
    window.addEventListener('openChangePhotoModal',event => {
        ChangePhotoModal.show();

    });
    //Hide Form Modal
    window.addEventListener('closeChangePhotoModal',event => {
        ChangePhotoModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseChangePhotoModal = document.getElementById('change-item-modal')
    ForceCloseChangePhotoModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceClosePhotoModal');
    });

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
    const BrandDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        BrandDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        BrandDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
</script>
@endpush
