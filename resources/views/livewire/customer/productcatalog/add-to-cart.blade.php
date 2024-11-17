<div>
    <form wire:submit.prevent="StoreProductCart">
        <div class="text-center rounded-md w-40 py-3">
            <div class=" flex-col justify-center items-center lg:items-start mt-4">
                <div class="font-bold tracking-wide text-primary text-xl ">₱{{ number_format($price )}}</div>
                <div class="text-slate-500">Price</div>
                <div class="flex  flex-row  h-8 w-50 justify-center items-center rounded-lg relative bg-transparent mt-1">
                    <button type="button" wire:click="DecrementQuantity" class="btn-secondary text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-7 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">−</span>
                    </button>
                    <input type="number" wire:model.debounce.500ms="quantity" id="quantity" onkeypress="return event.charCode >= 48" min="1" class="h-8 outline-none focus:outline-none text-center w-14 bg-gray-300 font-medium text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" />
                    <button type="button" wire:click="IncrementQuantity" class="btn-secondary text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-7 rounded-l cursor-pointer outline-none">
                        <span class="m-auto text-2xl font-thin">+</span>
                    </button>
                </div>
                <div class="text-slate-500">Quantity</div>
                <br>
                @if(Auth::guard('customer')->check())
                    <button type="submit" class="intro-x btn btn-primary mt-5 w-full" >Add to Cart</button>
                @else
                    <!-- BEGIN: Modal Toggle -->
                    <div class="text-center">
                        <button class="btn btn-primary" type="button" wire:click="LoginModal">Add to Cart</button>
                    </div> <!-- END: Modal Toggle -->
                    <!-- BEGIN: Modal Content -->
                    <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="p-5 text-center">
                                        <i data-lucide="x-circle" class="w-16 h-16 text-warning mx-auto mt-3"></i>
                                        <div class="text-3xl mt-5">Hi Customer</div>
                                        <div class="text-slate-500 mt-2">Before Ordering Create Account First</div>
                                    </div>
                                    <div class="px-5 pb-8 text-center">
                                        <button  data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                                    </div>
                                    <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                        <a href="{{ Route('CLogin.index') }}" class="text-primary">Please Login your {{ env('APP_NAME') }} Account First Before Ordering</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Modal Content -->

                @endif
                @push('scripts')
                    <script>
                        const warningModal = tailwind.Modal.getInstance(document.querySelector("#warning-modal-preview"));
                            window.addEventListener('openWarningModal',event => {
                                warningModal.show();
                            });
                    </script>
                @endpush
            </div>
        </div>
    </form>
</div>
