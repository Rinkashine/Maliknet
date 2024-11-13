@extends('admin.layout.admin')
@section('content')
@section('title', 'Inventory')
<h2 class="intro-y text-lg font-medium mt-10">Inventory</h2>
<!-- Begin: Product Inventory Table -->
<livewire:admin.inventory.product-inventory-table/>
<!-- End: Product Inventory Table -->
<!-- Begin: Inventory Adjust Modal -->
<livewire:admin.inventory.inventory-adjust-form/>
<!-- End: Inventory Adjust Modal -->
<!-- Begin: Inventory Edit Modal -->
<livewire:admin.inventory.inventory-edit-form/>
<!-- End: Inventory Edit Modal -->

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
    //Show Adjust Inventory Modal
    const adjustModal = tailwind.Modal.getInstance(document.querySelector("#adjust-item-modal"));
    window.addEventListener('openAdjustModal',event => {
        adjustModal.show();
    });
    //Hide Adjust Inventory Form Modal
    window.addEventListener('CloseModal',event => {
        adjustModal.hide();
    });
    //Closing Adjust Inventory Modal and Refreshing its value
    const adjust = document.getElementById('adjust-item-modal')
    adjust.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });

      //Show Edit Inventory Modal
    const editModal = tailwind.Modal.getInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('openEditModal',event => {
        editModal.show();
    });
    //Hide Edit Inventory Form Modal
    window.addEventListener('CloseModal',event => {
        editModal.hide();
    });

    //Closing Edit Inventory Modal and Refreshing its value
    const edit = document.getElementById('edit-item-modal')
    edit.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
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


    var inputBox = document.getElementById("inventoryedit");
        var invalidChars = [
          "e",
        ];

        inputBox.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });

    var inputBox = document.getElementById("inventoryAdjust");
        var invalidChars = [
          "e",
        ];

        inputBox.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });


</script>
@endpush
