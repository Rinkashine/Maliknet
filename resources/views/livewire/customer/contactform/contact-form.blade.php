<div>
    <form wire:submit.prevent="store" id="test">
        @csrf
        <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control @error('name') border-danger @enderror" placeholder="Full Name" wire:model.lazy="name">
                    <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label  class="form-label">Email</label>
                    <input  type="email" class="form-control @error('email') border-danger @enderror" placeholder="Email" wire:model.lazy="email">
                    <div class="text-danger mt-2">@error('email'){{$message}}@enderror</div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label  class="form-label">Phone Number</label>
                    <input  type="text" class="form-control @error('phone') border-danger @enderror" placeholder="Phone Number" name="phone" wire:model.lazy="phone">
                    <div class="text-danger mt-2">@error('phone'){{$message}}@enderror</div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control @error('subject') border-danger @enderror"placeholder="Subject" wire:model.lazy="subject">
                    <div class="text-danger mt-2">@error('subject'){{$message}}@enderror</div>
                </div>
                <div class="intro-y col-span-12" >
                    <label class="form-label mb-3">Message</label>
                    <div wire:ignore>
                        <textarea wire:model="message" id="editor" class="message" name="message" ></textarea>
                    </div>
                    <div class="text-danger mt-2">@error('message'){{$message}}@enderror</div>
                </div>
                <div wire:ignore class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button type="submit"
                    data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"
                    data-callback='handle'
                    data-action='contact'
                     class="g-recaptcha btn btn-primary w-24 ml-2">
                     Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then(function(editor){
                editor.model.document.on('change:data', () => {
                    @this.set('message', editor.getData());
                })
            })
            .catch( error => {
                console.error( error );
            });
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render={{env('CAPTCHA_SITE_KEY')}}"></script>
    <script>
        function handle(e) {
            grecaptcha.ready(function () {
                grecaptcha.execute('{{env('CAPTCHA_SITE_KEY')}}', {action: 'contact'})
                    .then(function (token) {
                        @this.set('captcha', token);
                    });
            });
        }
    </script>
    @endpush
</div>
