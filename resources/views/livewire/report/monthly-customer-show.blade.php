<div>
    <div class="intro-y flex justify-between items-center mt-8">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400">
            <a href="{{ Route('report.customerPerMonth') }}" class="mr-2 btn">←</a> {{$date}} Customers
        </div>
        <div>
            <a href="{{ Route('export.ShowMonthlyGainedCustomers',['from' => $from,'to' => $to]) }}" class="btn btn-primary"> Export </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <!-- BEGIN: Users Layout -->
        @forelse($users as $user)
            <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4">
                <div class="box">
                    <div class="flex items-start px-5 pt-5">
                        <div class="w-full flex flex-col lg:flex-row items-center">
                            <div class="w-16 h-16 image-fit">
                                @if(!empty($user->photo))
                                    <img src="{{ url('storage/customer_profile_picture/'.$user->photo) }}" data-action="zoom" alt="Missing Image">
                                @else
                                    <img alt="Missing Image" class="rounded-full" data-action="zoom" src="{{asset('dist/images/undraw_pic.svg')}}">
                                @endif
                            </div>
                            <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                                <a href="{{ Route('customer.show',$user->id) }}" class="font-medium">{{ $user->name }}</a>
                                <div class="text-slate-500 text-xs mt-0.5">
                                    Account Created: {{$user->created_at->toDayDateTimeString()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center lg:text-left p-5">
                    <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"> <i class="fa-solid fa-cake mr-1"></i> {{$user->birthday}} </div>
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"><i class="fa-regular fa-envelope mr-1"></i>{{ $user->email }} </div>
                        <div class="flex items-center justify-center lg:justify-start text-slate-500 mt-1"> <i class="fa-solid fa-phone mr-1"></i> {{ $user->phone_number }} </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="intro-y col-span-12 flex justify-center box p-10">
                <div class="flex justify-center flex-col">
                    <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                    <div class="flex justify-center mt-1">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
                </div>
            </div>
        @endforelse
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $users->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 form-select box mt-3 sm:mt-0">
                <option>9</option>
                <option>18</option>
                <option>27</option>
                <option>36</option>
            </select>
        <!-- END: Pagination -->
        </div>
    </div>
</div>
