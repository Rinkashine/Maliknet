<div>
    <div class="intro-y box p-5 mt-5">
        <!-- Topside -->
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <!-- Search -->
            <div class="w-full xl:flex sm:mr-auto" >
                <div class="w-full sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search</label>
                    <input type="search" wire:model.lazy="search" class="form-control w-full sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                </div>
            </div>
        </div>

        <!-- Customer List -->
       <div class="overflow-x-auto scrollbar-hidden">
           @if($customers->count())
           <div class="overflow-x-auto">
               <table class="table table-striped mt-5">
                   <thead>
                       <tr>
                           <th class="whitespace-nowrap ">Customer Name</th>
                           <th class="whitespace-nowrap text-center">Email</th>
                           <th class="whitespace-nowrap text-center">Phone Number</th>
                           <th class="whitespace-nowrap text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   @foreach($customers as $customer)
                       <tr>
                           <td class="whitespace-nowrap "><a href="{{ Route('customer.show',$customer) }}">{{$customer->name}}</a> </td>
                           <td class="whitespace-nowrap text-center">{{$customer->email}}</td>
                           <td class="whitespace-nowrap text-center">{{$customer->phone_number}}</td>
                           <td class="table-report__action w-56">
                               <div class="flex justify-center items-center">
                                   <div class="flex justify-center items-center">
                                        <button wire:click="selectItem({{$customer->id}},'restrict')" class="flex items-center">
                                            <i class="fa-solid fa-user-slash w-4 h-4 mr-1"></i>Restrict Account
                                        </button>
                                   </div>
                               </div>
                           </td>
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
               {!! $customers->onEachSide(1)->links() !!}
           </nav>
           <div class="mx-auto text-slate-500">
            Showing {{$customers->firstItem()}} to {{$customers->lastItem()}} of {{$customers->total()}} entries
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
