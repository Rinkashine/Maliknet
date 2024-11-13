
<div wire:ignore.self id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Category
                </h2>
            </div>
            <form wire:submit.prevent="StoreCategoryData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    @csrf
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Category Name: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="text" wire:offline.class="border-warning" id="title" wire:model.lazy="name" class="form-control flex-1 @error('name') border-danger @enderror" placeholder="Category Name" >
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                        <div class="text-warning mt-2" wire:offline> Attempting to Reconnect to the Internet...........</div>
                    </div>

                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Category Image: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="file" wire:model.lazy="photo"  placeholder="text" accept="image/*"  class="form-control p-1 flex-1 @error('photo') border-danger @enderror">
                        <div wire:loading wire:target="photo">Uploading...</div>
                        <div class="text-danger mt-2">@error('photo'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button" class="btn btn-outline-secondary w-32 mr-1" wire:offline.attr="disabled">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit" wire:offline.attr="disabled">
                </div>
            </form>
        </div>
    </div>
</div>





