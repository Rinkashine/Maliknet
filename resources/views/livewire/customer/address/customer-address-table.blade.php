<div class="sm:p-3">
    <div class="overflow-x-auto">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="whitespace-nowrap">Full Name</th>
                    <th class="text-center whitespace-nowrap">Address</th>
                    <th class="text-center whitespace-nowrap">Postcode</th>
                    <th class="text-center whitespace-nowrap">Phone Number</th>
                    <th class="text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody id="addressTbody" >
                @forelse ($address as $address)
                <tr >
                    <td class="whitespace-nowrap">{{ $address->name }}</td>
                    <td class="text-center whitespace-nowrap">{{ $address->house }}</td>
                    <td class="text-center whitespace-nowrap address" wire:ignore>{{ $address->province }}-{{ $address->city }}-{{ $address->barangay}}</td>
                    <td class="text-center whitespace-nowrap">{{ $address->phone_number }}</td>
                    <td class="text-center whitespace-nowrap">
                        @if($address->default_address == 0)
                            <button wire:click="selectItem({{$address->id}},'set')" class="mr-1" >
                                <i class="w-4 h-4 mr-1 fa-solid fa-location-dot"></i> Set Default
                            </button>
                        @endif
                        <a href="{{ Route('customer.address.edit', $address->id) }}" class="mr-1"><i class="w-4 h-4 mr-1 fa-regular fa-pen-to-square"></i> Edit</a>
                        <button wire:click="selectItem({{$address->id}},'delete')" class="text-danger"><i class="w-4 h-4 mr-1 fa-regular fa-trash-can" ></i> Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="px-5 py-5 text-lg">
                            <img alt="Address" class="block object-scale-down w-full mt-3 max-h-24 sm:hidden" src="{{ asset('dist/images/AddressMobile.svg') }}">
                            <p class="text-center sm:text-3xl bold">Let us know where to ship your products!</p>
                            <img alt="Address" class="hidden object-scale-down w-full mt-3 sm:block max-h-96" src="{{ asset('dist/images/Address.svg') }}">
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($countaddress <= 4)
        <div class="flex justify-end mt-3">
            <a href="{{ Route('customer.address.create') }}" class="btn btn-primary w-52">Add New Address</a>
        </div>
    @else
    <!-- BEGIN: Modal Toggle -->
    <div class="flex justify-end mt-3">
        <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#warning-modal-preview" class="btn btn-primary">
            Add New Address
        </a>
    </div>
    <!-- END: Modal Toggle -->
    <!-- BEGIN: Modal Content -->
    <div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="p-0 modal-body">
                    <div class="p-5 text-center">
                        <i class="mx-auto mt-3 fa-regular fa-circle-xmark fa-5x text-warning"></i>
                        <div class="mt-5 text-3xl">
                            Oops...
                        </div>
                        <div class="mt-2 text-slate-500">Something went wrong!</div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-tw-dismiss="modal" class="w-24 btn btn-primary">Ok</button>
                    </div>
                    <div class="p-5 text-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <a href="" class="text-primary">
                            You can only create up to 5 shipping address
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
