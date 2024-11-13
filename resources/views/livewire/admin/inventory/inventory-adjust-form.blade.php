
<div wire:ignore.self id="adjust-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Adjust Inventory for {{ $productname }}
                </h2>
            </div>
            <form wire:submit.prevent="AdjustInventoryData">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        <label for="pos-form-1" class="form-label">Adjust Stock</label>
                        <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">(Original Quantity: {{ $original }})</span>
                        <input type="number" id="inventoryAdjust" wire:model.lazy="inventoryAdjust" class="form-control flex-1 @error('inventory') border-danger @enderror" placeholder="Adjust Inventory" >
                        <div class="text-danger mt-2">@error('inventoryAdjust'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12">
                        <label for="pos-form-1" class="form-label">Reason:</label>
                        <select name="reason" id="reason" class="form-select" wire:model="reason">
                            <option value="">Select Reason</option>
                            <option value="Inventory Correction">Correction</option>
                            <option value="Inventory Manually Counted">Count</option>
                            <option value="Inventory Received">Received</option>
                            <option value="Items Restocked">Return Restock</option>
                            <option value="Damaged">Damaged</option>
                            <option value="Theft or Loss">Theft or Loss</option>
                            <option value="Promotion or donation">Promotion or Donation</option>
                        </select>
                        <div class="text-danger mt-2">@error('reason'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>





