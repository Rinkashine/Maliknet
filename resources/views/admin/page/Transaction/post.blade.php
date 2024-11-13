@extends('admin.layout.admin')
@section('content')
@section('title', 'Home Banner')

<h2 class="intro-y text-lg font-medium mt-10">
    Home Banner
</h2>

<!-- Begin: Banner Form -->
<livewire:admin.banner.home-banner-form/>
<!-- End: Banner Form -->
<!-- Begin: Home Banner Edit Form -->
<livewire:admin.banner.home-banner-edit-form/>
<!-- End: Home Banner Edit Form -->
<!-- Begin: Home Banner Table -->
<livewire:admin.banner.home-banner-table/>
<!-- End: Home Banner Table -->
<!-- Begin: Delete Banner -->
<livewire:admin.banner.delete-banner/>
<!-- End: Delete Banner -->
<livewire:admin.banner.home-banner-change-photo-form/>

<div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>

<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>

@endsection

@push('scripts')
<script>
    //Show Form Modal
    const myModal = tailwind.Modal.getInstance(document.querySelector("#add-item-modal"));
    window.addEventListener('OpenModal',event => {
        myModal.show();
    });
    //Hide Form Modal
    window.addEventListener('CloseModal',event => {
        myModal.hide();
    });
    //Closing Modal and Refreshing its value
    const myModalEl = document.getElementById('add-item-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //Show Edit Form Modal
    const BannerEditModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('openEditModal',event => {
        BannerEditModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseEditModal',event => {
        BannerEditModal.hide();
    });
    //Hide Modal and Refresh its value
    const EditForceClose = document.getElementById('edit-item-modal')
    EditForceClose.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseEditModal');
    });

    //Delete Modal
    const BannerDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        BannerDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        BannerDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });


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
</script>
@endpush
