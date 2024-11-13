@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit Role')
<!-- Begin: Roles and Permission Table -->
@livewire('admin.role-and-permission.role-permission-table',['role' => $role])
<!-- End: Roles and Permission Table -->
<!-- Begin: Set Permissions Form -->
@livewire('admin.role-and-permission.permission-form',['role' => $role->id])
<!-- End: Set Permissions Form -->
<!-- Begin: Revoke Permissions Form -->
<livewire:admin.role-and-permission.remove-permission/>
<!-- End: Revoke Permissions Form -->



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
    })

    //Show Revoke Modal
    const RevokeModal = tailwind.Modal.getInstance(document.querySelector("#delete-confirmation-modal"));
    window.addEventListener('openRevokeModal',event => {
        RevokeModal.show();
    });
    window.addEventListener('CloseRevokeModal',event => {
        RevokeModal.hide();
    });
    //Closing Modal and Refreshing its value
    const ForceCloseRevokeModal = document.getElementById('delete-confirmation-modal')
     myModalEl.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
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
