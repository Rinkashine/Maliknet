
<div wire:ignore.self id="adjust-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Adjust Order - {{ $product_name }} ₱{{ number_format($unitprice) }}
                </h2>
            </div>
            <form wire:submit.prevent="UpdateProductQuantity">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="pos-form-1" class="form-label">Quantity:        <span class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Stocks Left: {{ $stocksleft }}</span></label>
                        <input type="number" min="1" max="{{ $stocksleft }}" id="adjustquantity" wire:model.lazy="quantity" class="form-control flex-1 @error('quantity') border-danger @enderror" placeholder="Quantity" onkeypress="return event.charCode >= 48">
                        <div class="text-danger mt-2">@error('quantity'){{$message}}@enderror</div>
                        <label>Total Price: ₱{{ number_format($totalprice) }}</label>

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





