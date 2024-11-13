<div>
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Display Information
                </h2>
            </div>
            <div class="p-5">
                <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 2xl:col-span-6">
                                <div>
                                    <label for="update-profile-form-1" class="form-label">Customer Name:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="name" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Phone Number:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="phone" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Email</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="email" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-5" class="form-label">Account Created</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="created_at" disabled>
                                </div>
                            </div>

                            <div class="col-span-6 2xl:col-span-3">
                                <div class="mt-3 2xl:mt-0">
                                    <label for="update-profile-form-1" class="form-label">Gender:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="gender" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-5" class="form-label">Total Spent:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="₱ {{number_format($totalSpent,2)}}" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Total Products Ordered:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{$totalProducts}}" disabled>
                                </div>

                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Total Rejected Orders:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{$totalRejectedOrders}}" disabled>
                                </div>
                            </div>
                            <div class="col-span-6 2xl:col-span-3"">
                            <div class="mt-3 2xl:mt-0">
                                    <label for="update-profile-form-5" class="form-label">Birthday</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" wire:model="birthday" disabled>
                                </div>

                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Total Orders Made:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{$totalOrders}}" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Total Completed Orders:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{$totalCompletedOrders}}" disabled>
                                </div>
                                <div class="mt-3">
                                    <label for="update-profile-form-1" class="form-label">Total Cancelled Orders:</label>
                                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{$totalCancelledOrders}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                        <div class="border-2 border-dashed shadow-sm border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                @if(!empty($photo))
                                    <img src="{{ url('storage/customer_profile_picture/'.$photo) }}" data-action="zoom"  alt="Missing Image">
                                @else
                                     <img alt="Missing Image" class="rounded-full" src="{{asset('dist/images/undraw_pic.svg')}}">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="intro-y box mt-5 ">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    List of Orders
                </h2>
            </div>

            <div class="overflow-x-auto p-5 ">
            <div class="flex flex-col sm:flex-row sm:items-end xl:items-start py-3">
                    <div class="xl:flex sm:mr-auto" >
                        <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                            <label class="w-12 flex-none xl:w-auto xl:flex-initial mr-2">Search: </label>
                            <input type="search" wire:model.lazy="search" class="form-control sm:w-40 2xl:w-full mt-2 sm:mt-0" placeholder="Search...">
                        </div>
                    </div>
                </div>
                @forelse ($listoforders as $order)
                    <div class="mt-2 mb-5 border rounded-md">
                        <div class="flex flex-row justify-between px-3 py-5 border">
                <div>
                    #{{ $order->id }}
                    @if ($order->status == "Completed")
                        <span class="text-success">{{ $order->status }} </span>
                    @elseif($order->status == "Cancelled" || $order->status == "Rejected")
                        <span class="text-danger">{{ $order->status }}</span>
                    @else
                        <span class="text-pending">{{ $order->status }}</span>
                    @endif
                </div>
                <div class="px-2 text-right sm:text-center">
                    <span>Ordered Date: {{$order->created_at->toDayDateTimeString()}}</span>
                    <span class="rounded-full bg-slate-50  whitespace-nowrap pl-2">
                        <a href="{{ Route('orders.show',$order->id ) }}">
                            <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i> Show Details
                        </a>
                    </span>
                </div>
            </div>
            <div>
                <table class="table table-fixed bg-slate-50 table-bordered">
                    <tbody>
                        @foreach ($order->orderTransactions as $product)
                            <tr>
                                <td class="text-center truncate  whitespace-nowrap  ">
                                    {{ $product->product_name }}
                                </td>
                                <td class="text-center  whitespace-nowrap ">
                                    {{ $product->quantity }} pcs
                                </td>
                                <td class="text-center  whitespace-nowrap ">
                                    ₱{{ number_format($product->price,2) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">
                                @php
                                    $total = 0
                                @endphp
                                @foreach ($order->orderTransactions as $product)
                                    <?php $total += $product->quantity * $product->price ?>
                                @endforeach
                            Total: ₱{{number_format($total,2)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <div class="intro-y col-span-12 text-lg font-medium flex justify-center box p-10">
            <div class="flex justify-center flex-col">
                <img alt="Missing Image" class="object-fill  rounded-md h-48 w-96" src="{{ asset('dist/images/NoResultFound.svg') }}">
                <div class="flex justify-center mt-1">No Results found <strong class="ml-1"> {{ $search }}</strong>  </div>
            </div>
        </div>
        @endforelse

        <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
            <nav class="w-full sm:w-auto sm:mr-auto">
                {!! $listoforders->onEachSide(1)->links() !!}
            </nav>
            <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>25</option>
            </select>
        </div>
    </div>
</div>
