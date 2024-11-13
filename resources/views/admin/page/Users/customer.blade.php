@extends('admin.layout.admin')
@section('content')
@section('title', 'Customer')
<div class="intro-y flex justify-between  items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            List of Customers
         </h2>
    </div>
    @can('customer_archive_access')
    <div>
        <a href="{{ Route('CustomerArchiveIndex') }}" class="btn btn-primary">Restricted Accounts</a>
    </div>
    @endcan
</div>
<!-- Begin: Customer Table -->
<livewire:admin.customer.customer-table/>
<!-- End: Customer Table -->
<!--Begin: Restrict Customer Account -->
<livewire:admin.customer.restrict-customer-account/>

<!-- End: Restrict Customer Account -->



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

    //Delete Modal
    const openRestrictModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openRestrictModal',event => {
        openRestrictModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        openRestrictModal.hide();
    });
    //Hide Modal and Refresh its value
    const RestrictModal = document.getElementById('delete-confirmation-modal')
    RestrictModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
</script>
@endpush
