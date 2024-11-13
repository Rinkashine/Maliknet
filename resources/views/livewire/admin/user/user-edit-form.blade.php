<div>
    <form wire:submit.prevent="UpdateUserData">
        @csrf
        <div class="p-5">
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 xl:col-span-6">
                    <div>
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Employee Name: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input id="name" wire:model.lazy="name" type="text" class="form-control  @error('name') border-danger @enderror" >
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Email <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input id="email" wire:model.lazy="email" type="email" class="form-control  @error('email') border-danger @enderror">
                        <div class="text-danger mt-2">@error('email'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Role <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <select wire:model.lazy ="role" id="role" class="form-select  @error('role') border-danger @enderror">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger mt-2">@error('role'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select  id="gender" wire:model.lazy="gender" class="form-select @error('gender') border-danger @enderror">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="text-danger mt-2">@error('gender'){{$message}}@enderror</div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-6">
                    <div class="mt-3 xl:mt-0">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Date of Birth <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input id="Date of Birth" wire:model.lazy="birthday" type="date" class="form-control @error('birthday') border-danger @enderror">
                        <div class="text-danger mt-2">@error('birthday'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Phone Number <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input id="phone" wire:model.lazy="phone" type="text" class="form-control @error('phone') border-danger @enderror" >
                        <div class="text-danger mt-2">@error('phone'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-3">
                        <label for="name" class="form-label w-full flex flex-col sm:flex-row">Address: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span> </label>
                        <input id="address" wire:model.lazy="address" type="text" class="form-control @error('address') border-danger @enderror">
                        <div class="text-danger mt-2">@error('address'){{$message}}@enderror</div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary w-24 mt-3">Update</button>
            </div>
        </div>
    </form>
</div>
