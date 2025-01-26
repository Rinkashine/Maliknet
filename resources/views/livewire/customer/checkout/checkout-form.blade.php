<div>
    <form wire:submit.prevent="StoreCustomerOrder">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                <!-- BEGIN: Shipping Information -->
                <div class="mt-5 intro-y box">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex justify-between w-full">
                            <div>
                                <h2 class="mr-auto text-base font-medium">
                                    Shipping Address
                                </h2>
                            </div>
                            <div>
                                <button type="button" class="text-blue-400 underline cursor-pointer"  wire:click="selectItem({{ $updateAddress }},'editaddress')">Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        @foreach ($address as $address)
                            <div>
                                {{ $address->name }} - {{ $address->phone_number }}
                            </div>
                            <div>
                                Address: {{ $address->house }} | Postal Code: {{ $address->province }}-{{ $address->city }}-{{ $address->barangay }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END: Shipping Information -->
                <!-- BEGIN: ORDERS -->
                <div class="mt-5 intro-y box">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="mr-auto text-base font-medium">
                            Product Ordered
                        </h2>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="whitespace-nowrap">Product Name</th>
                                        <th class="text-center whitespace-nowrap">Unit Price</th>
                                        <th class="text-center whitespace-nowrap">Total Price</th>
                                        <th class="text-center whitespace-nowrap">Quantity</th>
                                        <th class="text-center whitespace-nowrap">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="whitespace-nowrap">{{ $order->product->name }}</td>
                                            <td class="text-center whitespace-nowrap">₱{{ number_format($order->product->price) }}</td>
                                            <td class="text-center whitespace-nowrap">₱{{ number_format($order->product->price * $order->quantity) }}</td>
                                            <td class="text-center whitespace-nowrap">{{ $order->quantity }}</td>
                                            <td class="flex items-center justify-center whitespace-nowrap" >
                                                @if(count($orders)  == 1)
                                                    <!-- BEGIN: Modal Toggle -->
                                                        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="text-danger">
                                                            <i class="w-4 h-4 mr-1 fa-regular fa-trash-can" ></i> Remove
                                                        </a>
                                                    <!-- END: Modal Toggle -->
                                                    <!-- BEGIN: Modal Content -->
                                                        <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="p-0 modal-body">
                                                                        <div class="p-5 text-center">
                                                                            <i class="mx-auto mt-3 fa-regular fa-circle-xmark fa-5x text-warning"></i>
                                                                            <div class="mt-5 text-3xl">Oops...</div>
                                                                            <div class="mt-2 text-slate-500">Something went wrong!</div>
                                                                        </div>
                                                                        <div class="px-5 pb-8 text-center">
                                                                            <button type="button" data-tw-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                                                                        </div>
                                                                        <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                                                                            <div class="text-primary">Your cart cannot be empty!</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- END: Modal Content -->
                                                @else
                                                    <button wire:click="selectItem({{ $order->id }},'remove')" class="flex items-center text-center text-danger" type="button">
                                                        <i class="w-4 h-4 mr-1 fa-regular fa-trash-can" ></i> Remove
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END: ORDERS -->
            </div>
            <div class="flex flex-col-reverse col-span-12 lg:col-span-4 2xl:col-span-3 lg:block">
                <div class="mt-5 intro-y box">
                    <div class="p-5 border-t border-slate-200/60">
                        <h1 class="mt-1 font-medium leading-none">Order Summary</h1>
                        <div class="flex justify-between mt-3">
                            <div>
                                <h1>Total (items)</h1>
                            </div>
                            <div>
                                <h1>₱{{ number_format($total) }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-slate-200/60">
                        <button type="submit" class="w-full h-12 mb-2 btn btn-primary">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
