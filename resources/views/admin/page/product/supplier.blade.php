@extends('admin.layout.admin')
@section('content')
@section('title', 'Supplier')
<!-- Begin: Header -->
<div class="intro-y flex justify-between  items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            Supplier List
         </h2>
    </div>
    @can('supplier_create')
    <div>
        <a href="{{Route('supplier.create')}}" type="button" class="btn btn-primary w-full sm:w-32" > </i> Add Supplier</a>
    </div>
    @endcan
</div>
<!-- End: Header -->
<!-- Begin: Supplier Table -->
<livewire:admin.supplier.supplier-table/>
<!-- End: Supplier Table -->
<!-- Begin Supplier Archive Modal -->
<livewire:admin.supplier.archive-supplier/>
<!-- End: Supplier Archive Modal -->
<!-- Begin: Success Notification-->
<div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Success Notification -->
<!-- Begin: Invalid Notification-->
<div id="invalid-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-xmark fa-3x text-danger mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium" id="title"></div>
        <div class="text-slate-500 mt-1" id="message"></div>
     </div>
</div>
<!-- End: Invalid Notification-->

<!-- Begin: Success Session Notification -->
@if(session('success'))
<div id="insert-success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
    <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Supplier Added Successfully</div>
        <div class="text-slate-500 mt-1">{{session('success')}}</div>
    </div>
</div>
<script>
Toastify({
    node: $("#insert-success-notification-content") .clone() .removeClass("hidden")[0],
    duration: 7000,
    newWindow: true,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true, }).showToast();
</script>
@endif
<!--End: Success Session Notification -->
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
    const SupplierArchiveModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openArchiveModal',event => {
        SupplierArchiveModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        SupplierArchiveModal.hide();
    });
    //Hide Modal and Refresh its value
    const ArchiveModal = document.getElementById('delete-confirmation-modal')
    ArchiveModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    })
</script>
@endpush
