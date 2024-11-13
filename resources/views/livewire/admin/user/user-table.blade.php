<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">
            <a class="mr-2 shadow-md btn btn-primary" href="{{ Route('user.create') }}">Add New User</a>
            <div class="dropdown">
                <button class="px-2 dropdown-toggle btn box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="flex items-center justify-center w-5 h-5"> <i class="fa-solid fa-plus"></i> </span>
                </button>
                <div class="w-40 dropdown-menu">
                    <ul class="dropdown-content">
                        <li>
                            <a href="{{ Route('UserArchiveIndex') }}" class="dropdown-item"><i class="w-4 h-4 mr-2 fa-solid fa-user-slash"></i> Deactivated Accounts </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden mx-auto md:block text-slate-500">
                @if($users->count() == 0)
                Showing 0 to 0 of 0 entries
                @else
                    Showing {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} entries
                @endif
            </div>
            <div class="w-full mt-3 sm:w-auto sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative w-56 text-slate-500">
                    <input type="search" wire:model.lazy="search" class="w-56 form-control box" placeholder="Search...">
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @forelse($users as $user)
        <div class="col-span-12 intro-y md:col-span-6 lg:col-span-4">
            <div class="box">
                <div class="flex items-start px-5 pt-5">
                    <div class="flex flex-col items-center w-full lg:flex-row">
                        <div class="w-16 h-16 image-fit">
                            @if(!empty($user->photo))
                                <img src="{{ url('storage/employee_profile_picture/'.$user->photo) }}" data-action="zoom" alt="Missing Image">
                            @else
                                <img alt="Missing Image" class="rounded-full" data-action="zoom" src="{{asset('dist/images/undraw_pic.svg')}}">
                            @endif
                        </div>
                        <div class="mt-3 text-center lg:ml-4 lg:text-left lg:mt-0">
                            <div  class="font-medium">{{ $user->name }}</div>
                            <div class="text-slate-500 text-xs mt-0.5">
                               @foreach($user->getRoleNames() as $name)
                                 {{ $name }}
                               @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 mt-3 mr-5 dropdown">
                        <a class="block w-5 h-5 dropdown-toggle" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown">
                            <i class="w-5 h-5 fa-solid fa-ellipsis-vertical text-slate-500"></i>
                        </a>
                        <div class="w-40 dropdown-menu">
                            <div class="dropdown-content">
                                <a href="{{ Route('user.edit',$user->id) }}" class="dropdown-item"> <i class="mr-1 fa-solid fa-pen"></i> Edit </a>
                                <button wire:click="selectItem({{$user->id}},'restrict')" class="flex items-center w-full dropdown-item">
                                    <i class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Deactivate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col p-5 space-y-4 text-center lg:text-left">
                    <div >
                        <div>Address: {{ $user->address }}</div>

                        <div class="flex items-center justify-center mt-5 lg:justify-start text-slate-500"><i class="mr-1 fa-regular fa-envelope"></i>{{ $user->email }} </div>
                        <div class="flex items-center justify-center mt-1 lg:justify-start text-slate-500"> <i class="mr-1 fa-solid fa-phone"></i> {{ $user->phone_number }} </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
        <div class="flex justify-center col-span-12 p-10 intro-y box">
            <div class="flex flex-col justify-center">
                <img alt="Missing Image" class="object-fill h-48 rounded-md w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                <div class="flex justify-center mt-1">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
            </div>
        </div>
        @endforelse
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="flex flex-wrap items-center col-span-12 intro-y sm:flex-row sm:flex-nowrap">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $users->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
