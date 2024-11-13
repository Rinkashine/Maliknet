@extends('admin.layout.admin')
@section('content')
@section('title', 'User')
<h2 class="intro-y text-lg font-medium mt-10">
    <a href="{{ Route('user.index') }}" class="mr-2 btn">←</a> List of Deactivated Users
</h2>

<!-- Begin: Users Archive Modal -->
<livewire:admin.user.user-archive-table/>
<!-- End: Users Archive Modal -->

<!-- Begin: Force Delete User Account -->
<livewire:admin.user.force-delete-user/>
<!-- End: Force Delete User Account -->

<!-- Begin: Restore User Account Modal -->
<livewire:admin.user.restore-user/>
<!-- End: Restore User Account Modal -->


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

    const CustomerRestoreModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#restore-modal"));
    //Show Restore Modal
    window.addEventListener('OpenRestoreModal',event => {
        CustomerRestoreModal.show();
    });
    //Hide Restore Modal
    window.addEventListener('closeRestoreModal',event => {
        CustomerRestoreModal.hide();
    });
    //Hide Modal and Refresh its value
    const RestoreModal = document.getElementById('restore-modal')
    RestoreModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });

     //Delete Modal
     const CustomerDeleteModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openDeleteModal',event => {
        CustomerDeleteModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        CustomerDeleteModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });




</script>
@endpush
