@extends('customer.layout.base')
@section('content')
@section('title', 'Checkout')
<!-- Begin: Customer Checkout Form -->
<livewire:customer.checkout.checkout-form/>
<!-- End: Customer Checkout Form -->

<!-- Begin: Remove Product From Checkout -->
<livewire:customer.checkout.remove-checkout/>
<!-- End: Remove Product From Checkout -->

<!-- Begin: Change Address in Checkout -->
<livewire:customer.checkout.change-address-form/>
<!-- End: Change Address in Checkout -->

@endsection
@push('scripts')

<script>
 //Delete Modal
 const RemoveToCheckoutModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#remove-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openRemoveModal',event => {
        RemoveToCheckoutModal.show();
        console.log('working');
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        RemoveToCheckoutModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('remove-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });


    const mySlideOver = tailwind.Modal.getOrCreateInstance(document.querySelector("#header-footer-slide-over-preview"));
    window.addEventListener('openAddressModal', function(event) {
        mySlideOver.show();
    });

    window.addEventListener('CloseAddressModal', function(event) {
        mySlideOver.hide();
    });
</script>
@endpush
