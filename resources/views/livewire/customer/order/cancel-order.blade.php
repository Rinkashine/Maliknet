<div>
    @if($status == "Pending for Approval")
        <div class="flex justify-end mt-5 intro-y">
            <button wire:click="selectItem({{ $order_id }}, 'cancel_order')"  class="btn btn-primary">Cancel</button>
        </div>
    @endif
</div>
