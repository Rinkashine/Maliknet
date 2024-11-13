<div wire:ignore.self  id="header-footer-slide-over-preview" class="modal modal-slide-over"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Shipping Address</h2>
            </div>
        <!-- END: Slide Over Header -->
        <!-- BEGIN: Slide Over Body -->
         <div class="modal-body">
            @foreach ($shippingaddresses as $addresses)
                <div class="p-4 border border-slate-300/60t rounded-md mt-2">
                    <div >
                        <div class="form-check mr-2 mt-2 sm:mt-0">
                            <input wire:model="updateAddress"  id="trylng" name="working" class="form-check-input"type="radio"  value="{{ $addresses->id }}">
                            <label class="form-check-label" for="radio-switch-6">{{ $addresses->name }} - {{ $addresses->phone_number }}</label>
                        </div>
                        <div>
                            address: {{ $addresses->house }}
                        </div>
                        <div class="text-slate-500">
                            Postal Code: {{ $addresses->province }}-{{ $addresses->city }}-{{ $addresses->barangay }}
                        </div>
                    </div>
                </div>
            @endforeach
         </div>
         <!-- END: Slide Over Body -->
         <!-- BEGIN: Slide Over Footer -->
         <div class="modal-footer w-full absolute bottom-0">
            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
            <button type="button" wire:click="UpdatedAddress" class="btn btn-primary w-20">Save</button>
        </div> <!-- END: Slide Over Footer -->
     </div>
    </div>
</div>
