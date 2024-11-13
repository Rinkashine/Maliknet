<div>
    <div wire:ignore.self  id="set-status-to-packed-modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i class="fa-regular fa-circle-check fa-4x text-success mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">
                            Are you sure?
                        </div>
                        <div class="text-slate-500 mt-2">
                            You want to set the status to Packed and Ready to Ship
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button wire:click="closeModal" type="button"  class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                        <button wire:click="UpdateOrderStatus" type="submit" class="btn btn-primary w-24">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
