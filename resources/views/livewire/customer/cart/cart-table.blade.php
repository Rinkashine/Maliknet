<div>
    @if(count($cart) == 0)
        <div class="flex items-center justify-center mt-48 intro-y">
            <div>
                <div>
                    <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                </div>
                <div class="flex justify-center mt-2 text-lg text-slate-600 font-medium leading-none mt-3">There are no items in this cart</div>
                <div class="flex justify-center mt-2">
                    <a href="{{ Route('product') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                </div>
            </div>
        </div>
    @else
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Cart
            </h2>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: Order Summary -->
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5">

                    <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <h1 class="font-medium leading-none mt-1">Order Summary</h1>
                        <div class="flex justify-between mt-3">
                            <div>
                                <h1>Subtotal (items)</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($subtotal)}}</h1>
                            </div>
                        </div>
                        <div class="flex justify-between mt-3 ">
                            <div>
                                <h1>Shipping Fee</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($shippingfee ) }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex justify-between mt-3 ">
                            <div>
                                <h1 class="font-medium leading-none mt-1 mb-2">Subtotal</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($total) }}</h1>
                            </div>
                        </div>

                        @if(empty(Auth::guard('customer')->user()->email_verified_at))
                            <!-- BEGIN: Modal Toggle -->
                            <div class="text-center">
                                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="btn btn-primary w-full mr-1 mb-1">Proceed to Checkout</a>
                            </div>
                            <!-- END: Modal Toggle -->
                            <!-- BEGIN: Modal Content -->
                            <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <i class="fa-regular fa-circle-xmark fa-5x text-warning mx-auto mt-3"></i>
                                                <div class="text-3xl mt-5">Oops...</div>
                                                <div class="text-slate-500 mt-2">Something went wrong!</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                                            </div>
                                            <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                                <a href="{{ Route('customer.profile') }}" class="text-primary">Please Verify Your Email Before Checking Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Modal Content -->
                        @elseif($shippingaddresscount == 0)
                            <!-- BEGIN: Modal Toggle -->
                            <div class="text-center">
                                <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="btn btn-primary w-full mr-1 mb-1">Proceed to Checkout</a>
                            </div>
                            <!-- END: Modal Toggle -->
                            <!-- BEGIN: Modal Content -->
                            <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="p-5 text-center">
                                                <i class="fa-regular fa-circle-xmark fa-5x text-warning mx-auto mt-3"></i>
                                                <div class="text-3xl mt-5">Oops...</div>
                                                <div class="text-slate-500 mt-2">Something went wrong!</div>
                                            </div>
                                            <div class="px-5 pb-8 text-center">
                                                <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Ok</button>
                                            </div>
                                            <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                                <a href="{{ Route('customer.address') }}" target="_blank" class="text-primary">Please Add Shipping Address Before Checking Out!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: Modal Content -->
                        @else
                            <form wire:submit.prevent="ProceedToCheckout">
                                <button type="submit" class="btn btn-primary w-full mr-1 mb-1">Proceed to Checkout</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END: Order Summary -->

            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <!-- BEGIN: Display Cart -->
                <div class="intro-y box lg:mt-5">
                    <div class="flex items-center p-5 border-b border-slate-200/60">
                        <h2 class="font-medium text-base mr-auto">
                            Cart
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="whitespace-nowrap text-center">#</th>
                                        <th class="whitespace-nowrap text-center">Product Name</th>
                                        <th class="whitespace-nowrap text-center">Quantity</th>
                                        <th class="whitespace-nowrap text-center">Unit Price</th>
                                        <th class="whitespace-nowrap text-center">Total Price </th>
                                        <th class="whitespace-nowrap text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $cart)
                                        <tr>
                                            <td class="whitespace-nowrap text-center w-20">
                                                <input type="checkbox" class="form-check-input" wire:click="add({{ $cart->id }})" value="1" @if($cart->check == true) checked @endif></td>
                                            <td class="whitespace-nowrap text-center">{{ $cart->product->name }}</td>
                                            <td class="whitespace-nowrap text-center">{{ $cart->quantity }}</td>
                                            <td class="whitespace-nowrap text-center">₱{{ $cart->product->sprice }}</td>
                                            <td class="whitespace-nowrap text-center">₱{{    number_format($cart->product->sprice * $cart->quantity)   }}</td>
                                            <td class="whitespace-nowrap flex justify-center items-center">
                                                <button wire:click="selectItem({{ $cart->id }},'adjust')" class="flex items-center mr-3" >
                                                    <i class="fa-regular fa-pen-to-square w-4 h-4 mr-1"></i> Adjust
                                                </button>
                                                <button wire:click="selectItem({{ $cart->id }},'remove')" class="flex items-center text-danger">
                                                    <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END: Display Cart -->
            </div>
        </div>
    @endif
</div>
