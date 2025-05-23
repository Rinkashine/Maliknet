<div>
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                    <select wire:model="sorting"  class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="nameaz" >Product Title A-Z</option>
                        <option value="nameza">Product Title Z-A</option>
                        <option value="createdold">Created (oldest first)</option>
                        <option value="creatednew">Created (newest first)</option>
                        <option value="updatedatold">Updated (oldest first)</option>
                        <option value="updatedat">Updated (newest first)</option>
                        <option value="cataz">Category A-Z</option>
                        <option value="catza">Category Z-A</option>
                    </select>
                </div>

                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                    <input wire:model.lazy="search" type="search" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>

            </div>
            @can('product_export')
                <div class="flex mt-5 sm:mt-0">
                    <div class="dropdown w-1/2 sm:w-auto">
                        <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa-regular fa-newspaper w-4 h-4 mr-2"></i> Export <i class="fa-solid fa-chevron-down w-4 h-4 ml-auto sm:ml-2"></i> </button>
                        <div class="dropdown-menu w-40">
                            <ul class="dropdown-content">
                                <li>
                                    <a href="{{Route('exportproductpdf')}}" class="dropdown-item"> <i class="fa-solid fa-file-excel mr-1"></i> Export Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
       <div class="overflow-x-auto scrollbar-hidden">
           @if($products->count())
           <div class="overflow-x-auto">
               <table class="table table-striped mt-5" id="datatable">
                   <thead>
                       <tr>
                           <th class="whitespace-nowrap ">Product Name</th>
                           <th class="whitespace-nowrap text-center">Category</th>
                           <th class="whitespace-nowrap text-center">Status</th>
                           @if (Auth::guard('web')->user()->can('product_show') || Auth::guard('web')->user()->can('product_edit') || Auth::guard('web')->user()->can('product_archive'))
                            <th class="whitespace-nowrap text-center">Actions</th>
                           @endif
                       </tr>
                   </thead>
                   <tbody>
                   @foreach($products as $product)
                       <tr class="intro-x">
                           <td class="whitespace-nowrap font-medium">
                            <a href="{{ Route('productshow', $product) }}" target="_blank">
                              <div class="hover:underline">{{$product->name}}</div>
                            </a>
                            </td>
                           <td class="whitespace-nowrap text-center">{{$product->category->name}}</td>

                           <td class="whitespace-nowrap">
                               @if($product->status == 1)
                                   <div class="flex items-center justify-center text-success"> <i class="fa-regular fa-square-check w-4 h-4 mr-1"></i> Active </div>
                               @elseif ($product->status == 0)
                                   <div class="flex items-center justify-center text-danger"> <i class="fa-regular fa-circle-xmark w-4 h-4 mr-1"></i> Draft </div>
                               @endif
                           </td>
                           @if (Auth::guard('web')->user()->can('product_show') || Auth::guard('web')->user()->can('product_edit') || Auth::guard('web')->user()->can('product_archive'))
                           <td class="table-report__action w-56">
                               <div class="flex justify-center items-center">
                                   <div class="flex justify-center items-center">
                                        @can('product_edit')
                                            <a class="flex items-center mr-3 text-primary" href="{{Route('product.edit',$product)}}">
                                                <i class="fa-regular fa-pen-to-square w-4 h-4 mr-1"></i> Edit
                                            </a>
                                        @endcan
                                        @can('product_archive')
                                            <button wire:click="selectItem({{$product->id}},'delete')" class="flex items-center text-danger">
                                                <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i> Delete
                                            </button>
                                        @endcan
                                   </div>
                               </div>
                           </td>
                           @endif
                       </tr>
                   @endforeach
                   </tbody>
               </table>
           </div>
           @else
            <h2 class="intro-y text-lg font-medium mt-10">
                <div class="flex justify-center flex-col">
                    <img alt="Missing Image" class="object-fill rounded-md h-48 " src="{{ asset('dist/images/NoResultFound.svg') }}">
                    <div class="flex justify-center">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
                </div>
            </h2>
           @endif
       </div>

       <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
           <nav class="w-full sm:w-auto sm:mr-auto">
               {!! $products->onEachSide(1)->links() !!}
           </nav>
           <div class="mx-auto text-slate-500">
                @if($products->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} entries
                @endif
            </div>
           <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
               <option>10</option>
               <option>25</option>
               <option>35</option>
               <option>50</option>
           </select>
       </div>
    </div>
</div>
