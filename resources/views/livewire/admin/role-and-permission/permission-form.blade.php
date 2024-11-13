
<div wire:ignore.self id="add-item-modal" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Permission
                </h2>
            </div>
            <form wire:submit.prevent="StorePermissionData">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12">
                        @csrf
                        <label for="permission-form" class="form-label">Permission Name:</label>
                        <select wire:model="name" id="" class="form-select" >
                            <option value="">Select Permission</option>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button wire:click="closeModal" type="button" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                    <input type="submit" class="btn btn-primary w-32" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>





