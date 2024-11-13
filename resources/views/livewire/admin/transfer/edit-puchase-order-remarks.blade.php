
<div wire:ignore.self id="edit-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                   Editing Remarks
                </h2>
            </div>
            <form wire:submit.prevent="UpdateRemarksData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    @csrf
                    <div class="col-span-12">
                        <label for="remarks" class="form-label w-full flex flex-col sm:flex-row">Remark:</label>
                        <textarea  wire:model.lazy="remarks" class="form-control" id="" cols="30" rows="10"></textarea>
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeEditModal" type="button" class="btn btn-outline-secondary w-32 mr-1"  wire:offline.attr="disabled">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit"  wire:offline.attr="disabled">
                </div>
            </form>
        </div>
    </div>
</div>





