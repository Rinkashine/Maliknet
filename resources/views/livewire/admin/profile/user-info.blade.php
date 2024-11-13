<div>
    <div class="flex flex-col-reverse xl:flex-row flex-col">
        <div class="flex-1 mt-6 xl:mt-0">
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 2xl:col-span-6">
                    <div>
                        <label for="update-profile-form-1" class="form-label">Display Name</label>
                        <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->name}}" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->email}}" disabled>
                    </div>
                    <div class="mt-3 ">
                        <label for="Gender" class="form-label">Phone Number</label>
                        <input id="Gender" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->phone_number}}" disabled>
                    </div>
                </div>

                <div class="col-span-12 2xl:col-span-6">
                    <div class="mt-3 2xl:mt-0">
                        <label for="Gender" class="form-label">Gender</label>
                        <input id="Gender" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->gender}}" disabled>
                    </div>
                    <div class="mt-3">
                        <label for="Age" class="form-label">Date of Birth</label>
                        <input id="Age" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->birthday}}" disabled>
                    </div>
                    <div class="mt-3 ">
                        <label for="Address" class="form-label">Address</label>
                        <input id="Address" type="text" class="form-control" placeholder="Input text" value="{{Auth::guard('web')->user()->address}}" disabled>
                    </div>
                </div>


            </div>
            <div class="flex justify-end">
                <button type="button"  wire:click="selectItem('edit_info')" class="btn btn-primary w-32 mt-8">
                    Edit Information
                </button>
            </div>
        </div>
        <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
            <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                    @if(!empty(Auth::guard('web')->user()->photo))
                        <img src="{{ url('storage/employee_profile_picture/'.Auth::guard('web')->user()->photo) }}" data-action="zoom"  alt="Missing Image">
                    @else
                        <img alt="Missing Image" class="rounded-md" data-action="zoom" src="{{asset('dist/images/undraw_pic.svg')}}">
                    @endif
                </div>
                <div class="mx-auto cursor-pointer relative mt-5">
                    <button class="btn btn-primary w-full" type="button" wire:click="selectItem('change_photo')">Change Photo</button>
                </div>
            </div>
        </div>
    </div>
    <livewire:admin.profile.change-photo-form/>
    <livewire:admin.profile.employee-change-information/>

    @push('scripts')
    <script>

           const ChangePhotoModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-modal"));
            window.addEventListener('openChangePhotoModal',event => {
                ChangePhotoModal.show();

            });
            //Hide Form Modal
            window.addEventListener('CloseChangePhotoModal',event => {
                ChangePhotoModal.hide();
            });
            //Closing Modal and Refreshing its value
            const ForceCloseChangePhotoModal = document.getElementById('change-profile-modal')

            ForceCloseChangePhotoModal.addEventListener('hidden.tw.modal', function(event) {
                livewire.emit('forceClosePhotoModal');
            });


            const EditInfoModal = tailwind.Modal.getInstance(document.querySelector("#change-profile-information-modal"));
            window.addEventListener('openEditInfoModal',event => {
                EditInfoModal.show();
            });
            //Hide Form Modal
            window.addEventListener('CloseEditInfoModal',event => {
                EditInfoModal.hide();
            });




    </script>
    @endpush

</div>
