<div class="flex-1 mt-6 xl:mt-0">
    <div class="grid grid-cols-12 gap-x-5">
        <div class="col-span-12 2xl:col-span-6">
            <div>
                <label for="fullname" class="form-label">Full Name</label>
                <input id="fullname" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('customer')->user()->name}}" disabled>
            </div>
            <div class="mt-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('customer')->user()->email}}" disabled>
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-6">
            <div class="mt-3 2xl:mt-0">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input id="phone_number" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('customer')->user()->phone_number}}" disabled>
            </div>
            <div class="mt-3">
                <label for="gender" class="form-label">Gender</label>
                <input id="gender" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('customer')->user()->gender}}" disabled>
            </div>
        </div>
        <div class="col-span-12">
            <div class="mt-3">
                <label for="age" class="form-label">Birthday</label>
                <input id="age" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('customer')->user()->birthday}}" disabled>
            </div>
        </div>
    </div>
    <div class="flex justify-end gap-2">
        @if(Auth::guard('customer')->user()->password == null)
            <button class="btn btn-primary w-32 mt-3" type="button" wire:click="selectItem({{Auth::guard('customer')->user()->id}},'SetPassword')">Set Password</button>
        @endif
        <button class="btn btn-primary w-32 mt-3" type="button" wire:click="selectItem({{Auth::guard('customer')->user()->id}},'edit')">Edit Information</button>
    </div>
</div>
