<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <!-- BEGIN: Display Permission  -->
    <div class="intro-y box mt-2 lg:mt-5">
        <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
            <h2 class="font-medium text-base mr-auto">
                <a href="{{ Route('role.index') }}" class="mr-2 btn">←</a>{{ $role->name }} - List of Permissions
            </h2>
            <div class="text-center">
                <a href="javascript:;"  data-tw-toggle="modal" data-tw-target="#add-item-modal" class="btn btn-primary w-full mr-1">
                    <i class="fa-solid fa-add w-4 h-4 mr-1"></i>Add Permissions
                </a>
            </div>
        </div>
        <div class="p-5">
            @if($role->permissions)
                @forelse($role->permissions as $role_permission)
                    <button wire:click="selectItem({{$role->id}},{{ $role_permission->id }},'revoke')" class="btn btn-elevated-rounded-danger mr-1 mb-2">{{ $role_permission->name }} </button>

                @empty
                <h2 class="intro-y text-lg font-medium mt-10">
                    <div class="flex justify-center flex-col">
                        <img alt="Missing Image" class="object-fill rounded-md h-48 " src="{{ asset('dist/images/NoResultFound.svg') }}">
                        <div class="flex justify-center">No Set of Permission Found  </div>
                    </div>
                </h2>
                @endforelse
            @endif
        </div>
    </div>
</div>
