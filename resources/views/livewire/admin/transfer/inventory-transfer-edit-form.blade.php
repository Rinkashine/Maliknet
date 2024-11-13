<div>
    <form wire:submit.prevent="UpdateTransferData">
        <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-12">
                @if ($errors->any())
                    <div class="alert alert-danger show mb-2" role="alert">
                        <div class="flex items-center">
                            <div class="font-medium text-lg">Whoops Something Went Wrong</div>
                            <div class="text-xs bg-white px-1 rounded-md text-slate-700 ml-auto">Error</div>
                        </div>
                        <div class="mt-3">
                            @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Begin: Supplier Information -->
                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <div class="font-medium text-base">
                                Supplier
                            </div>
                            @if($toggleinfo)
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
                                                @foreach ($supplierinfo as $info)
                                                    {{ $info->address }}
                                                @endforeach
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
                                                @foreach ($supplierinfo as $info)
                                                    <li>{{ $info->contact_name }}</li>
                                                    <li>{{ $info->email }}</li>
                                                    <li>{{ $info->contact_number }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                            @endif
                        </div>
                        <div class="mt-5">
                            <!-- Supplier Origin -->
                            <div class="form-inline items-start flex-col mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Supplier Origin</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 flex-1">
                                    <select wire:model="origin" class="form-select" @if($status != "Draft") disabled @endif>
                                        <option value="">Select Origin</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('origin')
                                        <div class="text-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Supplier Information -->
                <!-- BEGIN: Add Products -->
                <div class="intro-y box p-5 mt-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="flex justify-between items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                            <div class="font-medium text-base">
                                Add Products
                            </div>
                        </div>
                        <div class="mt-5">
                            @if($status != "Pending")
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <div class="intro-x relative">
                                            <input type="search" class="form-control" wire:model="query" >
                                            <div class="absolute z-50 h-fit w-full rounded-b-lg bg-white shadow-2xl py-2 px-2 mt-2">
                                                <div wire:loading wire:target="query" class="flex items-center font-medium ">
                                                    <div>Searching...</div>
                                                </div>
                                                @if (!empty($query))
                                                <div class="search-result__content">
                                                    @if(!empty($products))
                                                        @foreach($products as $product)
                                                        <div class="flex flex-col sm:flex-row w-full  mt-2 border rounded font-medium px-2 py-2 ">
                                                            <div class="2xl:w-full xl:w-full lg:w-full md:w-full text-left" >
                                                                <button wire:click="AddTd({{json_encode($product)}})" type="button" class=" text-left" >
                                                                    {{ $product['name']}}
                                                                </button>
                                                            </div>
                                                            <div class="w-2/4 sm:w-full sm:ml-5 text:left sm:text-center">
                                                                <div class="ml-auto truncate text-slate-500 text-xs">SKU {{ $product['SKU'] }}</div>
                                                            </div>
                                                            <div class="w-1/4 sm:w-full sm:ml-5 text:left sm:text-right">
                                                                <div class="ml-auto  text-slate-500 text-xs">Current Stock: {{ $product['stock'] }}</div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @else
                                                        <div class="flex items-center mt-2 font-medium">No Results Found</div>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(!empty($selectedProducts))
                                <div class="overflow-x-auto mt-5">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="whitespace-nowrap">Product Name</th>
                                                <th class="whitespace-nowrap text-center">SKU</th>
                                                <th class="whitespace-nowrap text-center">Quantity</th>
                                                <th class="whitespace-nowrap text-center">Price Per Item</th>
                                                <th class="whitespace-nowrap text-center">Discount</th>
                                                <th class="whitespace-nowrap text-center">Total Cost</th>
                                                <th class="whitespace-nowrap text-center">Discounted Total Cost</th>

                                                @if($status != "Pending")
                                                    <th class="whitespace-nowrap text-center">Action </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $overallcost = 0;
                                            @endphp
                                            @foreach ($selectedProducts as $key=>$selectedproduct)
                                                <tr>
                                                    <td class="whitespace-nowrap">{{ $selectedproduct['name'] }}</td>
                                                    <td class="whitespace-nowrap text-center">{{ $selectedproduct['SKU'] }}</td>
                                                    <td class="whitespace-nowrap text-center">
                                                        @if($status == "Pending")
                                                            <span class="flex justify-center">{{ $selectedproduct['quantity'] }} pcs</span>
                                                        @else
                                                            <input type="number" wire:model='selectedProducts.{{ $key }}.quantity'  min="1" class="form-control @error('selectedProducts.'.$key.'.quantity') border-danger @enderror" onkeypress="return event.charCode >= 48">
                                                            @error('selectedProducts.'.$key.'.quantity')
                                                                <div class="text-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        @endif
                                                    </td>
                                                    <td class="whitespace-nowrap text-center">
                                                        @if($status == "Pending")
                                                            <span class="flex justify-center">₱{{ $selectedproduct['price'] }}</span>
                                                        @else
                                                            <input type="number" wire:model='selectedProducts.{{ $key }}.price' min="1"  class="form-control @error('selectedProducts.'.$key.'.price') border-danger @enderror" onkeypress="return event.charCode >= 48">
                                                            @error('selectedProducts.'.$key.'.price')
                                                                <div class="text-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        @endif
                                                    </td>
                                                    <td class="whitespace-nowrap text-center">
                                                        @if($status == "Pending")
                                                            <span class="flex justify-center">{{ $selectedproduct['discount'] }}%</span>
                                                        @else
                                                            <input type="number" wire:model='selectedProducts.{{ $key }}.discount' max="100" min="0" placeholder="0-100" class="form-control @error('selectedProducts.'.$key.'.discount') border-danger @enderror" >
                                                            @error('selectedProducts.'.$key.'.discount')
                                                                <div class="text-danger mt-2">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        @endif
                                                    </td>
                                                    <td class="whitespace-nowrap text-center">
                                                        @php
                                                            if($selectedproduct['quantity'] == null || $selectedproduct['price'] == null){
                                                                $totalcost = 0;
                                                            }else{
                                                                $totalcost = $selectedproduct['quantity'] * $selectedproduct['price'];
                                                            }
                                                        @endphp
                                                        ₱{{ number_format($totalcost,2) }}
                                                    </td>
                                                    <td class="whitespace-nowrap text-center">
                                                        @php
                                                            if($selectedproduct['discount'] == null){
                                                                $discountprice = $totalcost;
                                                            }else{
                                                                $discountprice = $totalcost - (($selectedproduct['discount'] /100) * $totalcost);
                                                            }
                                                            $overallcost += $discountprice;

                                                        @endphp
                                                        ₱{{ number_format($discountprice,2) }}
                                                    </td>
                                                   @if($status != "Pending")
                                                        <td class="whitespace-nowrap text-center">
                                                            <button type="button" wire:click="DeleteTd({{ json_encode($selectedproduct)}}, {{ $key }})" class="text-danger"><i class="fa-solid fa-trash mr-1"></i>Delete</button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <td colspan="8" class="whitespace-nowrap text-right">
                                                        Overall Cost: ₱{{ number_format($overallcost,2) }}
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                 <!-- END: Add Products -->
                <!--  Begin: Shipping Details and Estimate Delivery Time -->
                 <div class="flex justify-between flex-col  md:flex-col lg:flex-row  2xl:flex-row  sm:flex-col gap-5 ">
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
                                                <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <input type="date" wire:model="shipping" class="form-control" data-single-mode="true" @if($status != "Draft") disabled @endif>
                                        @error('shipping')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                            <input type="text" wire:model="tracking" class="form-control" @if($status != "Draft") disabled @endif>
                                            @error('tracking')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                            </div>
                            <div class="mt-5">
                                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                    <div class="w-full mt-3 xl:mt-0 flex-1">
                                        <textarea class="form-control" rows="5" wire:model="remarks">{!! $remarks !!}</textarea>
                                        @error('remarks')
                                            <div class="text-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <!-- End: Shipping Details and Estimate Delivery Time -->
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
                                @if($status != "Pending")
                                    <div class="flex md:contents">
                                        <div class="relative col-start-2 col-end-4 mr-10 md:mx-auto">
                                        <div class="flex items-center justify-center w-6 h-full">
                                            <div class="w-1 h-full bg-gray-300 pointer-events-none"></div>
                                        </div>
                                        <div class="absolute w-6 h-6 -mt-3 text-center bg-gray-300 rounded-full shadow top-1/2">
                                            <i class="mt-1 text-gray-400 fas fa-exclamation-circle"></i>
                                        </div>
                                        </div>
                                        <div class="w-full col-start-4 col-end-12 p-4 my-4 mr-auto bg-gray-300 shadow-md rounded-xl">
                                        <h3 class="mb-1 text-lg font-semibold text-gray-400">Mark as Pending</h3>
                                        <p class="leading-tight text-justify">

                                        </p>
                                        </div>
                                    </div>
                                @endif

                                <div class="flex md:contents">
                                    <div class="relative col-start-2 col-end-4 mr-10 md:mx-auto">
                                      <div class="flex items-center justify-center w-6 h-full">
                                        <div class="w-1 h-full bg-gray-300 pointer-events-none"></div>
                                      </div>
                                      <div class="absolute w-6 h-6 -mt-3 text-center bg-gray-300 rounded-full shadow top-1/2">
                                        <i class="mt-1 text-gray-400 fas fa-exclamation-circle"></i>
                                      </div>
                                    </div>
                                    <div class="w-full col-start-4 col-end-12 p-4 my-4 mr-auto bg-gray-300 shadow-md rounded-xl">
                                      <h3 class="mb-1 text-lg font-semibold text-gray-400">Received the Items</h3>
                                      <p class="leading-tight text-justify">

                                      </p>
                                    </div>
                                </div>

                            </div>
                          </div>
                        </div>
                    </div>
                 </div>
                 <!-- End: Purchase Order Timeline -->
            </div>
        </div>
        @if($status != "Pending")
            <div class="intro-y flex justify-end flex-col md:flex-row gap-2 ">
                <div class="flex justify-end flex-col md:flex-row gap-2 ">
                    <button wire:click="Cancel" type="button" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</button>
                    <input type="submit" class="btn py-3 btn-primary w-full md:w-52" value="Save">
                </div>
            </div>
        @endif
    </form>
</div>
