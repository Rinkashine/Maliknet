
<div wire:ignore.self id="set-password-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Set Password
                </h2>
            </div>
            <form wire:submit.prevent="StoreNewPassword">
                @csrf
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Password:<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="password" wire:model.lazy="password" class="form-control flex-1  @error('password') border-danger @enderror" placeholder="Password" >
                        <div class="text-danger mt-2">@error('password'){{$message}}@enderror</div>
                    </div>

                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Confirm Password: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input type="password" wire:model.lazy="password_confirmation"  class="form-control flex-1 @error('password_confirmation') border-danger @enderror">
                        <div class="text-danger mt-2">@error('password_confirmation'){{$message}}@enderror</div>
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





