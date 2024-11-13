

<div wire:ignore.self id="change-order-status-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Are you sure want to change the order status
                </h2>
            </div>
            <form wire:submit.prevent="ChangeOrderStatus">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="pos-form-1" class="form-label">Status:</label>
                        <select wire:model="status" class="w-full form-select" id="">
                            <option value="Processing">Processing</option>
                            <option value="Packed and Ready to Ship">Packed and Ready to Ship</option>
                            <option value="Out for Delivery">Out for Delivery</option>
                            <option value="Completed">Completed</option>
                        </select>
                        <div class="text-danger mt-2">@error('status'){{$message}}@enderror</div>

                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button"  class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>





