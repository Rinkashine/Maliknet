<div>


    <form wire:submit.prevent="UpdateProductData">
        <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
            <div class="intro-y col-span-12">
                <!-- Begin: Product Information -->
                <div class="intro-y box p-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Product Information  </div>
                        <div class="mt-5">
                            <!-- Product Title -->
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Product Name</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                        <div class="leading-relaxed text-slate-500 text-xs mt-3"> Include min. 40 characters to make it more attractive and easy for buyers to find, consisting of product type, brand, and information such as color, material, or type. </div>

                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <input id="product-name" wire:model.lazy="name" type="text" class="form-control  @error('name') border-danger @enderror" placeholder="Product name">
                                    <div class="text-danger mt-2">@error('name'){{$message}}@enderror</div>
                                </div>
                            </div>
                            <!-- END: Product Title -->

                            <!-- Begin: Category Name -->
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Category Name</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <select wire:model="category"  class="form-select w-full @error('category') border-danger @enderror"  >
                                        <option value="">Select A Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2">@error('category'){{$message}}@enderror</div>
                                </div>
                            </div>
                            <!-- END: Category Name -->
                            <!-- Begin: Price -->
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Price</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <input id="product-price" type="number" min="0" wire:model.lazy="price" class="form-control  @error('price') border-danger @enderror" placeholder="Input Product Price">
                                    <div class="text-danger mt-2">@error('price'){{$message}}@enderror</div>
                                </div>
                            </div>
                            <!-- END: Price -->

                            <!-- BEGIN: Status -->
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Product Status</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>

                                        </div>
                                        <div class="leading-relaxed text-slate-500 text-xs mt-3"> If the status is active, your product can be searched for by potential buyers. </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1">
                                    <select wire:model="status"  class="form-select w-full @error('status') border-danger @enderror"  >
                                        <option value="">Select A Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <div class="text-danger mt-2">@error('status'){{$message}}@enderror</div>
                                </div>
                            </div>
                            <!-- END: Status -->
                            <!-- BEGIN: Product Detail -->
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Product Description</div>
                                            <div class="ml-2 px-2 py-0.5 bg-slate-200 text-slate-600 dark:bg-darkmode-300 dark:text-slate-400 text-xs rounded-md">Required</div>
                                        </div>
                                        <div class="leading-relaxed text-slate-500 text-xs mt-3">
                                            <div>Make sure the product description provides a detailed explanation of your product so that it is easy to understand and find your product.</div>
                                            <div class="mt-2">It is recommended not to enter info on mobile numbers, e-mails, etc. into the product description to protect your personal data.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1" >
                                    <div wire:ignore>
                                        <textarea wire:model="description" id="editor" class="description" name="description" > {!! $description !!}</textarea>
                                    </div>
                                    <div class="text-danger mt-2">@error('description'){{$message}}@enderror</div>
                                </div>
                            </div>
                            <!-- END: Product Detail -->
                        </div>
                    </div>
                </div>
                <!-- END: Product Information -->
                <!-- BEGIN: Product Media -->
                <div class="intro-y box p-5 mt-5">
                    <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> Media </div>
                        <div class="mt-5">
                            <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                                <div class="form-label xl:w-64 xl:!mr-10">
                                    <div class="text-left">
                                        <div class="flex items-center">
                                            <div class="font-medium">Product Photos</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3 xl:mt-0 flex-1" >
                                    <input  id="upload{{ $iteration }}" type="file" class="form-control p-2" wire:model="images" multiple accept="image/*" >
                                    <div class="text-danger mt-2">@error('images.*'){{$message}}@enderror</div>
                                    <div wire:loading wire:target="images">Uploading...</div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" class="ml-2 btn btn-primary" wire:click="StoreNewImages" >Add New Image</button>
                                </div>
                            </div>
                            <div class="intro-y grid grid-cols-12 gap-6 mt-5" id="datatable">
                                @foreach ($product_images as $image)
                                    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 ">
                                        <div class="p-5">
                                            <div class="flex items-center justify-center ">
                                                <img class="object-contain h-48 " src="{{ url('storage/product_photos/'.$image->images) }}"  data-action="zoom" alt="Missing Product Image" onerror="this.onerror=null;this.src='{{ asset('dist/images/ImageNotFound.png') }}'">
                                            </div>
                                            <div class="flex justify-center">
                                                <button type="button" wire:click="selectItem({{$image->id}},'delete')"   class="block font-medium text-center mt-2">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="intro-y p-5 flex justify-end flex-col md:flex-row gap-2 ">
                    <div class="flex justify-end flex-col md:flex-row gap-2 mt-5">
                        <a href="{{ Route('product.index') }}" class="btn py-3 border-slate-300 dark:border-darkmode-400 text-slate-500 w-full md:w-52">Cancel</a>
                        <input type="submit" class="btn py-3 btn-primary w-full md:w-52" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="success-notification-content" class="toastify-content hidden flex non-sticky-notification-content">
        <i class="fa-regular fa-circle-check fa-3x text-success mx-auto"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium" id="title"></div>
            <div class="text-slate-500 mt-1" id="message"></div>
         </div>
    </div>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then(function(editor){
            editor.model.document.on('change:data', () => {
                @this.set('description', editor.getData());
            })
        })
        .catch( error => {
            console.error( error );
        } );

</script>
@endpush

</div>



