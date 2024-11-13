<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="hidden md:block mx-auto text-slate-500">
                @if($users->count() == 0)
                Showing 0 to 0 of 0 entries
                @else
                    Showing {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} entries
                @endif
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" wire:model.lazy="search" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @forelse($users as $user)
        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
            <div class="box">
                <div class="flex items-start px-5 pt-5">
                    <div class="w-full flex flex-col lg:flex-row items-center">
                        <div class="w-16 h-16 image-fit">
                            @if(!empty($user->photo))
                                <img src="{{ url('storage/employee_profile_picture/'.$user->photo) }}" data-action="zoom" class="" alt="Missing Image">
                            @else
                                <img alt="Missing Image" class="rounded-full" data-action="zoom" src="{{asset('dist/images/undraw_pic.svg')}}">
                            @endif
                        </div>
                        <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $user->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">
                               @foreach($user->getRoleNames() as $name)
                                 {{ $name }}
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center lg:text-left p-5">
                    <div>Address: {{ $user->address }}</div>
                    <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-5"><i class="fa-regular fa-envelope mr-1"></i>{{ $user->email }} </div>
                    <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"> <i class="fa-solid fa-phone mr-1"></i> {{ $user->phone_number }} </div>
                </div>
                <div class="text-center lg:text-right p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                    @can('user_restore')
                        <button wire:click="selectItem({{$user->id}},'restore')"  class="btn btn-primary py-1 px-2 mr-2">Restore</button>
                    @endcan
                    @can('user_forcedelete')
                        <button wire:click="selectItem({{$user->id}},'delete')" class="btn btn-danger py-1 px-2">Delete</button>
                    @endcan
                </div>
            </div>
        </div>
        @empty
        <div class="intro-y col-span-12 flex justify-center box p-10">
            <div class="flex justify-center flex-col">
                <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                <div class="flex justify-center mt-1">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
            </div>
        </div>
        @endforelse


        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $users->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
