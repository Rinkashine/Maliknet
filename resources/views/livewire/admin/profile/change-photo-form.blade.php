
<div wire:ignore.self id="change-profile-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Customer Change Profile
                </h2>
            </div>
            <form wire:submit.prevent="StoreUserProfile">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="pos-form-1" class="form-label">Photo</label>
                        <input type="file" wire:model="photo" class="form-control flex-1 p-2 @error('photo') border-danger @enderror"  accept="image/*">
                        <div wire:loading wire:target="photo">Uploading...</div>
                        <div class="text-danger mt-2">@error('photo'){{$message}}@enderror</div>
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





