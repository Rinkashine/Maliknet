<div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            @can('category_create')
                <button class="btn btn-primary shadow-md mr-2" data-tw-toggle="modal" data-tw-target="#add-item-modal">Add New Category</button>
            @endcan

            <div class="hidden md:block mx-auto text-slate-500">
                @if($category->count() == 0)
                    Showing 0 to 0 of 0 entries
                @else
                    Showing {{$category->firstItem()}} to {{$category->lastItem()}} of {{$category->total()}} entries
                @endif
            </div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="search" wire:model.lazy="search" class="form-control w-56 box " placeholder="Search...">
                </div>
            </div>
        </div>

        <!-- BEGIN: Category Layout -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NAME</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($category as $categories)
                <tr class="intro-x">
                    <td>
                        <p class="font-medium whitespace-nowrap" >{{$categories->name}}</p>
                    </td>
                    <td class="table-report__action w-72">
                        <div class="flex justify-center items-center">
                            @can('category_edit')
                                <button wire:click="selectItem({{ $categories->id }},'edit')"  class="flex items-center mr-3" >
                                    <i class="fa-regular fa-pen-to-square w-4 h-4 mr-1"></i> Edit
                                </button>
                            @endcan

                            @can('category_delete')
                                <button wire:click="selectItem({{$categories->id}},'delete')"  class="flex items-center mr-3 text-danger">
                                    <i class="fa-regular fa-trash-can w-4 h-4 mr-1" ></i>  Delete
                                </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">No Result Found</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Category Layout -->

        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $category->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>12</option>
                <option>24</option>
                <option>36</option>
                <option>48</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
