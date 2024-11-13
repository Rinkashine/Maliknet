
<div wire:ignore.self id="cancel-order-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Cancellation Request
                </h2>
            </div>
            <form wire:submit.prevent="CancelOrder">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    @csrf
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Cancellation Reason: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <select wire:model.lazy="reason" class="form-select" id="">
                                <option value="">Select Reason</option>
                            @foreach ($reasons as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger mt-2">@error('reason'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Detailed Explanation:</label>
                        <textarea  wire:model.lazy="details" class="form-control" id="" cols="30" rows="10"></textarea>
                        <div class="text-danger mt-2">@error('details'){{$message}}@enderror</div>
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



