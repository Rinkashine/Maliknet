@extends('admin.layout.admin')
@section('content')
@section('title', 'Edit Transfer')
<!-- Begin: Header -->
<div class="intro-y flex justify-between items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ Route('transfer.index') }}" class="mr-2 btn">←</a> P{{ $orderinfos->id }}
            @if($orderinfos->status == "Pending")
                <span class=" btn-rounded btn-pending-soft w-12 text-sm mr-1 mb-2 p-1">
                    {{ $orderinfos->status }}
                </span>
            @elseif($orderinfos->status == "Draft")
                <span class=" btn-rounded btn-warning-soft w-12 text-sm mr-1 mb-2 p-1">
                    {{ $orderinfos->status }}
                </span>
            @elseif($orderinfos->status == "Received")
                <span class=" btn-rounded btn-success-soft w-12 text-sm mr-1 mb-2 p-1">
                    {{ $orderinfos->status }}
                </span>
            @else
            <div class=" btn-rounded btn-success-soft w-12 text-sm mr-1 mb-2 p-1">
                {{ $orderinfos->status }}
            </div>
            @endif
         </h2>
    </div>
    <div>
        @if($orderinfos->status == "Pending")
            <a href="{{ Route('inventory.receive', $orderinfos->id) }}" class="btn btn-primary">Receive Inventory</a>
        @elseif($orderinfos->status == "Draft")
            <div class="flex gap-1">
                <a onclick="deletePurchaseOrder('{{$orderinfos->id}}')" href="javascript:;" class="btn btn-danger">
                    Delete
                </a>
                <livewire:admin.transfer.delete-purchase-order/>
                @livewire('admin.transfer.inventory-transfer-mark-as-pending',['info' => $orderinfos])
                <livewire:admin.transfer.mark-as-pending-modal/>
            </div>
        @endif
    </div>
</div>
<!-- End: Header -->
<!-- Begin: Inventory Transfer Edit Form -->
@livewire('admin.transfer.inventory-transfer-edit-form',['orderinfos' => $orderinfos])
<!-- End: Inventory Transfer Edit Form -->
@endsection

@push('scripts')
    <script>
        //mark-as-pending-modal
        //OpenMarkAsPendingModal
        const PendingModal = tailwind.Modal.getInstance(document.querySelector("#mark-as-pending-modal"));
        window.addEventListener('OpenMarkAsPendingModal',event=>{
            PendingModal.show();
        });
        //Hide Order Notes Modal
        window.addEventListener('CloseMarkAsPendingModal',event=>{
            PendingModal.hide();
        });
        //Hide Modal and Refresh its value
        const RefreshPendingModal = document.getElementById('mark-as-pending-modal')
        RefreshPendingModal.addEventListener('hidden.tw.modal', function(event) {
            livewire.emit('forceCloseModal');
        });
        //Delete Purchase Order
        const deletepurchaseordermodalelement = document.querySelector("#delete-confirmation-modal");
        const deletepurchaseordermodal =  tailwind.Modal.getOrCreateInstance(deletepurchaseordermodalelement)
        const deletePurchaseOrder = (purchaseorderid)=>{
            livewire.emit("PurchaseOrderID", purchaseorderid);
        }

        window.addEventListener('CloseDeleteModal',event => {
            deletepurchaseordermodal.hide()
        });
        window.addEventListener('showDeleteModal', event => {
            deletepurchaseordermodal.show()
        });

    </script>
@endpush
