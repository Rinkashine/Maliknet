@extends('customer.layout.base')
@section('content')
@section('title', 'Edit Address')
<!-- Begin: Header -->
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
            Welcome to {{ env('APP_NAME') }}!
    </h2>
</div>
<!-- End: Header -->
<!-- Begin: Edit Address Body -->
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    @include('customer.component.side-profile')
    <!-- END: Profile Menu -->
    <!-- BEGIN: ADDRESS FORM  -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Edit Shipping Address for {{ $address->name }}
                </h2>
            </div>
            <div class="p-5">
                <!-- Show All Error in Field -->
                @if ($errors->any())
                    <div class="alert alert-danger show mb-4" role="alert">
                        <div class="flex items-center">
                            <div class="font-medium text-lg">Whoops Something Went Wrong</div>
                            <div class="text-xs bg-white px-1 rounded-md text-slate-700 ml-auto">Error</div>
                        </div>
                        <div class="mt-3">
                            @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(session('fail'))
                     <div class="alert alert-danger show flex items-center mb-2" role="alert"> <i data-lucide="alert-octagon" class="w-6 h-6 mr-2"></i> {{ session('fail') }} </div>
                @endif
                <form action="{{ Route('customer.address.edit', $address->id ) }}" method="POST">
                @csrf
                <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xl:col-span-6">
                        <div>
                            <label for="name" class="form-label">Full Name</label>
                            <input id="name" type="text" class="form-control" placeholder="First Last" name="full_name" value="{{old('full_name') ?? $address->name}}">
                        </div>
                        <div class="mt-3">
                            <label for="mobile_number" class="form-label">Mobile Number</label>
                            <input id="mobile_number" type="tel" class="form-control" placeholder="Please enter your mobile number" name="phone_number"  value="{{old('phone_number') ?? $address->phone_number}}">
                        </div>
                        <div class="mt-3">
                            <label for="notes" class="form-label">Other Notes</label>
                            <input id="notes" type="text" class="form-control" placeholder="Please enter your notes" name="notes" value="{{old('notes') ?? $address->notes}}">
                        </div>
                    </div>
                    <div class="col-span-12 xl:col-span-6">
                        <div class="mt-3 xl:mt-0">
                            <label for="house" class="form-label">House/Unit/Flr #</label>
                            <input id="house" type="text" class="form-control" placeholder="Please enter your complete shipping address" name="house" value="{{old('house') ?? $address->house}}">
                        </div>
                        <div class="mt-3">
                            <label for="Province" class="form-label">Province</label>
                            <select id="Province" class="form-select w-full" name="province"  >
                                <option value="">Province of shipping address</option>

                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="city" class="form-label">City/Municipality</label>
                            <select id="City" class="form-select w-full" name="city">
                                <option value="">City of shipping address</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <select id="Barangay" class=" w-full form-select" name="barangay">
                                <option value="">Barangay of shipping address</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-3">
                    <a href="{{ Route('customer.address') }}" class="btn btn-secondary w-32 mt-3">
                        Cancel
                    </a>
                    <button class="btn btn-primary w-32 mt-3">Edit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
     <!-- End: ADDRESS FORM  -->
</div>
<!-- End: Edit Address Body -->
@endsection
@push('scripts')
<script src="{{ asset('dist/js/address.js') }}"></script>
<script>
    const province ="{{old('province') ?? $address->province}}"
    const city = "{{old('city') ?? $address->city}}"
    const brgy= "{{old('barangay') ?? $address->barangay}}"
    window.MODE = "EDIT"
    window.address = {
        province,
        city,
        brgy
    }
</script>
@endpush
