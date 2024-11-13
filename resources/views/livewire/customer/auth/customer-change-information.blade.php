

 <div  wire:ignore.self  id="change-profile-information-modal" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <!-- BEGIN: Modal Header -->
             <div class="modal-header">
                 <h2 class="font-medium text-base mr-auto">Update Profile Information</h2>
             </div> <!-- END: Modal Header -->
             <!-- BEGIN: Modal Body -->
             <form wire:submit.prevent="UpdateProfileInformation">
                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-1" class="form-label">Full Name</label>
                        <input id="modal-form-1" type="text" wire:model.lazy="name" class="form-control bg-stone-800	  @error('name') bg-red-400	 border-danger @enderror" placeholder="Please Enter Your Full Name">
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-2" class="form-label" >Phone Number:</label>
                        <input id="modal-form-2" type="tel" class="form-control  @error('phone') border-danger @enderror" placeholder="Please Enter Your Phone Number" wire:model.lazy="phone">
                        <div class="text-danger mt-2">@error('phone'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-3" class="form-label">Gender:</label>
                        <select class="form-select @error('gender') border-danger @enderror" wire:model.lazy="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="text-danger mt-2">@error('gender'){{$message}}@enderror</div>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-4" class="form-label ">Birthday:</label>
                        <input id="modal-form-4" type="date" class="form-control  @error('birthday') border-danger @enderror" wire:model.lazy="birthday">
                        <div class="text-danger mt-2">@error('birthday'){{$message}}@enderror</div>
                    </div>
                </div> <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button type="button"  wire:click="CloseModal"  class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-20">Update</button>
                </div>
                <!-- END: Modal Footer -->
             </form>
         </div>
     </div>
 </div>
