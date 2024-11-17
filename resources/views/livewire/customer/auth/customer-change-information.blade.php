

 <div  wire:ignore.self  id="change-profile-information-modal" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <!-- BEGIN: Modal Header -->
             <div class="modal-header">
                 <h2 class="font-medium text-base mr-auto">Update Profile Information</h2>
             </div> <!-- END: Modal Header -->
             <!-- BEGIN: Modal Body -->
             <form wire:submit.prevent="UpdateProfileInformation">
                <div class="modal-body">
                    <div>
                        <label for="modal-form-1" class="form-label">Full Name</label>
                        <input id="modal-form-1" type="text" wire:model.lazy="name" class="form-control bg-stone-800	  @error('name') bg-red-400	 border-danger @enderror" placeholder="Please Enter Your Full Name">
                        <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                    </div>
                    <div class="mt-2">
                        <label for="modal-form-2" class="form-label" >Phone Number:</label>
                        <input id="modal-form-2" type="tel" class="form-control  @error('phone') border-danger @enderror" placeholder="Please Enter Your Phone Number" wire:model.lazy="phone">
                        <div class="text-danger mt-2">@error('phone'){{$message}}@enderror</div>
                    </div>
                </div>
                <!-- END: Modal Body -->
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
