
<div wire:ignore.self id="request-refund-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Request Return/Refund
                </h2>
            </div>
            <form wire:submit.prevent="StoreRequestForRefund">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    @csrf
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">
                            Reason:<span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span>
                         </label>
                         <select class="form-control w-full" wire:model.lazy="returnreason">
                            <option value="">Select Reason</option>
                            @foreach ($reasons as $reason)
                                <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                            @endforeach
                         </select>
                        <div class="text-danger mt-2">@error('returnreason'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">
                            Description:
                         </label>
                         <textarea class="form-control w-full" cols="30" rows="10" wire:model.lazy="description"></textarea>
                        <div class="text-danger mt-2">@error('description'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Proof <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input  type="file" class="form-control p-2 @error('images') border-danger @enderror" wire:model="images" multiple accept="image/*" >


                        <div wire:loading wire:target="photo">Uploading...</div>
                        <div class="text-danger mt-2">@error('images'){{$message}}@enderror</div>
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





