<div>
    <div class="items-center justify-center flex" >
        <div class="intro-y box py-10 sm:py-10 mt-2" style="width: 54rem">
            <div class="px-1 mt-0">
                <div class="font-medium text-center text-lg">Setup Your Account</div>
                <div class="text-slate-500 text-center mt-2">To start off, please enter your username, email address and password.</div>
            </div>
            <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
                <form wire:submit.prevent="StoreCustomerData">
                    @csrf
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Full Name
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Please Enter Your Name" wire:model.lazy="name">
                            <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Email
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, Email</span>
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" wire:model.lazy="email">
                            <div class="text-danger mt-2">@error('email'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Phone Number
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, PH</span>
                            </label>
                            <input type="tel"  class="form-control" placeholder="Phone Number" wire:model.lazy="phone">
                            <div class="text-danger mt-2">@error('phone'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Gender
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span>
                            </label>
                            <select name="gender" class="form-select" wire:model.lazy="gender">
                                <option value="">Select Gender</option>
                                <option value="Male" >Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <div class="text-danger mt-2">@error('gender'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Password
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, min: 8</span>
                            </label>
                            <input type="password" wire:model.lazy="password" class="form-control" placeholder="Password" >
                            <div class="text-danger mt-2">@error('password'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Password Confirmation</label>
                            <input type="password" wire:model.lazy="password_confirmation" class="form-control" placeholder="Password Confirmation" >
                            <div class="text-danger mt-2">@error('password_confirmation'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label w-full flex flex-col sm:flex-row">
                                Birthday
                                <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required</span>
                            </label>
                            <input type="date" max="{{ $maxdate }}" class="form-control" wire:model.lazy="birthday" id="birthday">
                            <div class="text-danger mt-2">@error('birthday'){{$message}}@enderror</div>
                        </div>
                        <div class="intro-y col-span-12 md:col-span-6">
                            <div class="w-full" >
                                <div wire:ignore>
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display(['data-callback' => 'onloadCallback']) !!}
                                </div>
                                <div class="text-danger mt-2">@error('recaptcha'){{$message}}@enderror</div>
                            </div>
                        </div>
                    </div>
                    <button class="intro-x btn btn-primary mt-5 w-full">Register</button>
                    <div class="text-slate-500 text-justify mt-4 intro-x">
                        By proceeding to sign up,I acknowledge that I have read and consented to Go Dental <a href="{{ Route('terms') }}" class="text-success">Terms of Use</a> and <a href="{{ Route('privacy') }}" class="text-success">Privacy Policy</a>,
                        which sets out how Go Dental collects, uses and discloses my personal data, and the rights that
                        I have under applicable law.
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
             document.addEventListener('livewire:load', function () {
                var todayDate = new Date();
                var month = todayDate.getMonth() + 1;
                var year =  todayDate.getUTCFullYear();
                var tdate = todayDate.getDate();
                if(month < 9){
                    month = "0" + month;
                }
                if(tdate < 10){
                    tdate = "0" + tdate;
                }
                var maxDate = year + "-" + month + "-" + tdate;
                @this.maxdate = maxDate;
            });
          var onloadCallback = function() {
                @this.set('recaptcha',grecaptcha.getResponse());
            };
        </script>
    @endpush
</div>
