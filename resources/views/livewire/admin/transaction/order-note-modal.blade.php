

<div wire:ignore.self id="order-notes-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Notes
                </h2>
            </div>
            <form wire:submit.prevent="StoreNoteData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="pos-form-1" class="form-label">Note:</label>
                        <input type="text"  wire:model.lazy="notes" class="form-control flex-1 @error('notes') border-danger @enderror" placeholder="Notes..." >
                        <div class="text-danger mt-2">@error('notes'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button"  class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>





