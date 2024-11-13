@extends('admin.layout.admin')
@section('content')
@section('title', 'Show Transfer')
<!-- Begin: Header -->
<div class="intro-y flex justify-between items-center mt-8">
    <div>
        <h2 class="text-lg font-medium mr-auto">
            <a href="{{ Route('transfer.index') }}" class="mr-2 btn">←</a> P{{ $orderinfo->id }}
            <span class=" btn-rounded btn-success-soft w-full text-sm mr-1 mb-2 p-1">
                {{ $orderinfo->status }}
            </span>
         </h2>
    </div>
</div>

<div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
    <div class="intro-y col-span-12">
        <!-- Begin: Supplier Information -->
        <div class="intro-y box p-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                    <div class="font-medium text-base">
                        Supplier
                    </div>
                    <div class="dropdown">
                        <button type="button" class="dropdown-toggle underline text-blue-400" aria-expanded="false" data-tw-toggle="dropdown">
                            View Supplier Info
                        </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <div class="dropdown-header">Address</div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    {{ $orderinfo->suppliers->address }}
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="dropdown-header">Contact</div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>{{ $orderinfo->suppliers->contact_name }}</li>
                                <li>{{ $orderinfo->suppliers->email }}</li>
                                <li>{{ $orderinfo->suppliers->contact_number }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Supplier Origin -->
                <div class="mt-5 form-inline items-start flex-col mt-5 pt-5 first:mt-0 first:pt-0">
                    <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                            <div class="flex items-center">
                                <div class="font-medium">Supplier Origin</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full mt-3 flex-1">
                        <input type="text" disabled class="form-control w-full" value="{{ $orderinfo->suppliers->name }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Supplier Information -->
        <!-- BEGIN: Ordered Products -->
        <div class="intro-y box p-5 mt-5">
            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                    <div class="font-medium text-base">
                        Ordered products
                    </div>
                </div>
                <div class="mt-5">
                    <div class="overflow-x-auto mt-5">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th class="whitespace-nowrap">Product Name</th>
                                    <th class="whitespace-nowrap text-center">SKU</th>
                                    <th class="whitespace-nowrap text-center">Received</th>
                                    <th class="whitespace-nowrap text-center">Price Per Item</th>
                                    <th class="whitespace-nowrap text-center">Discount</th>
                                    <th class="whitespace-nowrap text-center">Total Cost</th>
                                    <th class="whitespace-nowrap text-center">Total with Discounted Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $overallcost= 0;
                                @endphp
                                @foreach ($orderinfo->ordered_items as $item)
                                    <tr>
                                        <td  class="whitespace-nowrap ">{{ $item->product->name }}</td>
                                        <td  class="whitespace-nowrap text-center">{{ $item->product->SKU }}</td>
                                        <td  class="whitespace-nowrap text-center">{{ $item->accepted_quantity }} of {{ $item->quantity }}</td>
                                        <td  class="whitespace-nowrap text-center">₱{{ number_format($item->price,2) }}</td>
                                        <td  class="whitespace-nowrap text-center">{{ $item->discount }}%</td>
                                        <td class="whitespace-nowrap text-center">   ₱{{ number_format($item->accepted_quantity * $item->price,2) }}</td>
                                        <td class="whitespace-nowrap text-center">
                                            @php
                                                $total = ($item->accepted_quantity * $item->price) -
                                                (($item->discount / 100)  * ($item->accepted_quantity * $item->price));
                                                $overallcost += $total;
                                            @endphp
                                            ₱{{ number_format($total,2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td colspan="7" class="whitespace-nowrap text-right">
                                           Overall Cost:  ₱{{ number_format($overallcost,2) }}
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Ordered Products -->
        <!-- Begin: Shipment and Additional Details -->
        <div class="flex intro-y justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
            <div class=" box p-5 mt-5 w-full">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <div class="font-medium text-base">
                            Shipping Details
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-5">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">Estimated Arrival:</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <input type="date" class="form-control" data-single-mode="true" disabled  value="{{ $orderinfo->shipping_date }}">
                            </div>
                        </div>
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="form-label xl:w-64 xl:!mr-5">
                                <div class="text-left">
                                    <div class="flex items-center">
                                        <div class="font-medium">Tracking Number:</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <div class="relative w-full mx-auto">
                                    <input type="text" wire:model="tracking" class="form-control" disabled value="{{ $orderinfo->tracking }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" box p-5 mt-5 w-full">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                        <div class="font-medium text-base">
                            Remarks
                        </div>
                        <div>
                            <a onclick="EditRemarks('{{$orderinfo->id}}')" class="flex items-center ml-auto text-primary">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </a>
                            <livewire:admin.transfer.edit-puchase-order-remarks/>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                            <div class="w-full mt-3 xl:mt-0 flex-1">
                                <textarea class="form-control" rows="5" disabled>{!! $orderinfo->remarks !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Shipment and Additional Details -->
        <!-- Begin: Purchase Order Timeline -->
        <div class="p-5 mt-5 intro-y box">

            <div class="">
                <div class="p-4 mt-4">
                    <h1 class="mb-6 ml-5 text-base font-medium">Timeline</h1>
                    <div class="flex items-center justify-between pb-5 mb-5 border-b border-slate-200/60 dark:border-darkmode-400"></div>
                  <div class="container">
                    <div class="flex flex-col grid-cols-12 md:grid text-gray-50">

                        @foreach ($purchase_order_timeline as $item)
                        <div class="flex md:contents">
                            <div class="relative col-start-2 col-end-4 mr-10 md:mx-auto">
                              <div class="flex items-center justify-center w-6 h-full">
                                <div class="w-1 h-full pointer-events-none bg-success"></div>
                              </div>
                              <div class="absolute w-6 h-6 -mt-3 text-center rounded-full shadow bg-success top-1/2">
                                <i class="mt-1 text-white fas fa-check-circle"></i>
                              </div>
                            </div>
                            <div class="w-full col-start-4 col-end-12 p-4 my-4 mr-auto shadow-md bg-success rounded-xl">
                              <h3 class="mb-1 text-lg font-semibold">{{ $item->title }}</h3>
                              <p class="leading-tight text-justify">
                                {{ $item->created_at->DiffForHumans() }}
                              </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                  </div>
                </div>
            </div>
</div>
        <!-- End: Purchase Order Timeline -->
    </div>
</div>
@push('scripts')
<script>

    const EditRemarks = (orderId,)=>{
        livewire.emit("EditRemarks", orderId);
    }
    const editItemModal = tailwind.Modal.getInstance(document.querySelector("#edit-item-modal"));
    window.addEventListener('ShowEditModal',event => {
        editItemModal.show();
    });
    window.addEventListener('CloseEditModal',event => {
        editItemModal.hide();
    });


</script>

@endpush
@endsection

