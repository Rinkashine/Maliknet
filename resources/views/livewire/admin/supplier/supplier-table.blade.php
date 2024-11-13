<div>
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <div class="xl:flex sm:mr-auto" >
                <div class="sm:flex items-center sm:mr-4">
                    <label class="flex-none xl:w-auto xl:flex-initial mr-2">Sort</label>
                    <select wire:model="sorting" class="form-select w-full sm:w-32 2xl:w-full mt-2 sm:mt-0 sm:w-auto">
                        <option value="nameaz" >Supplier Name A-Z</option>
                        <option value="nameza">Supplier Name Z-A</option>
                        <option value="createdold">Created (oldest first)</option>
                        <option value="creatednew">Created (newest first)</option>
                        <option value="updatedatold">Updated (oldest first)</option>
                        <option value="updatedat">Updated (newest first)</option>
                    </select>
                </div>
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Value</label>
                    <input type="search" wire:model.lazy="search" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
            </div>
            @can('supplier_export')
                <div class="intro-y flex mt-5 sm:mt-0">
                    <a href="{{Route('exportsupplierpdf')}}" class="btn btn-primary">Export</a>
                </div>
            @endcan
        </div>
       <div class="overflow-x-auto scrollbar-hidden">
           @if($suppliers->count())
           <div class="overflow-x-auto">
               <table class="table table-striped mt-5 table-hover" >
                   <thead>
                       <tr>
                           <th class="whitespace-nowrap ">Company Name</th>
                           <th class="whitespace-nowrap text-center">Contact Name</th>
                           <th class="whitespace-nowrap text-center">Email</th>
                           <th class="whitespace-nowrap text-center">Contact Number</th>
                           <th class="whitespace-nowrap text-center">Address</th>
                           @if (Auth::guard('web')->user()->can('edit supplier_show') || Auth::guard('web')->user()->can('supplier_edit') || Auth::guard('web')->user()->can('supplier_archive'))
                            <th class="whitespace-nowrap text-center">Actions</th>
                           @endif

                       </tr>
                   </thead>
                   <tbody>
                        @foreach($suppliers as $supplier)
                            <tr class="intro-x">
                                <td class="whitespace-nowrap hover:underline"><a href="{{ Route('supplier.show',$supplier) }}">{{$supplier->name}}</td>
                                <td class="whitespace-nowrap text-center">{{$supplier->contact_name}}</td>
                                <td class="whitespace-nowrap text-center">{{$supplier->email}}</td>
                                <td class="whitespace-nowrap text-center">{{$supplier->contact_number}}</td>
                                <td class="whitespace-nowrap text-center">{{ $supplier->address }}</td>
                                @if (Auth::guard('web')->user()->can('supplier_show') || Auth::guard('web')->user()->can('supplier_edit') || Auth::guard('web')->user()->can('supplier_archive'))
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <div class="flex justify-center items-center">
                                                @can('supplier_show')
                                                    <a class="flex items-center mr-3    " href="{{ Route('supplier.show',$supplier) }}"> <i class="fa-solid fa-eye w-4 h-4 mr-1"></i> Show </a>
                                                @endcan
                                                @can('supplier_edit')
                                                    <a class="flex items-center mr-3 text-primary" href="{{ Route('supplier.edit',$supplier) }}" > <i class="fa-regular fa-pen-to-square w-4 h-4 mr-1"></i> Edit </a>
                                                @endcan
                                                @can('supplier_archive')
                                                    <button wire:click="selectItem({{$supplier->id}},'archive')" class="flex items-center text-danger">
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
                    <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                    <div class="flex justify-center">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
                </div>
            </h2>
           @endif
       </div>

       <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
           <nav class="w-full sm:w-auto sm:mr-auto">
               {!! $suppliers->onEachSide(1)->links() !!}
           </nav>
           <div class="mx-auto text-slate-500">
                @if($suppliers->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$suppliers->firstItem()}} to {{$suppliers->lastItem()}} of {{$suppliers->total()}} entries
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
