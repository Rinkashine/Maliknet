

<div wire:ignore.self id="order-reject-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Are you want to reject this order!
                </h2>
            </div>
            <form wire:submit.prevent="StoreRejectData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="pos-form-1" class="form-label">Reason:</label>
                        <input type="text"  wire:model.lazy="remarks" class="form-control flex-1 @error('remarks') border-danger @enderror" placeholder="Rejected Reason" >
                        <div class="text-danger mt-2">@error('remarks'){{$message}}@enderror</div>

                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button"  class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <input type="submit" class="btn btn-danger w-32" value="Reject">
                </div>
            </form>
        </div>
    </div>
</div>





