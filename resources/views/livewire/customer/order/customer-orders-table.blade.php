<div class="sm:p-3">
    @forelse ($Orders as $order)
        <div class="mt-2 mb-5 border rounded-md">
            <div class="flex flex-row justify-between px-3 py-5 border">
                <div>
                    #{{ $order->id }}
                    @if ($order->status == "Completed" || $order->status == "Refunded")
                        <span class="text-success">{{ $order->status }} </span>
                    @elseif($order->status == "Cancelled" || $order->status == "Rejected" || $order->status == "Return Request Rejected")
                        <span class="text-danger">{{ $order->status }}</span>
                    @else
                        <span class="text-pending">{{ $order->status }}</span>
                    @endif
                </div>
                <div class="px-2 rounded-full bg-slate-50">
                    <span class="text-center">
                        <a href="{{ Route('order.show',$order->id ) }}">
                            <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i>
                            Show Details
                        </a>
                    </span>
                </div>
            </div>
            <div>
                <table class="table table-fixed bg-slate-50 table-bordered">
                    <tbody>
                        @php
                            $limit = 0;
                        @endphp
                        @foreach ($order->orderTransactions as $product)
                            @if($limit < 5)
                            <tr>
                                <td class="text-center truncate whitespace-nowrap ">
                                    {{ $product->product_name }}
                                </td>
                                <td class="text-center whitespace-nowrap ">
                                    {{ $product->quantity }} pcs
                                </td>
                                <td class="text-center whitespace-nowrap ">
                                    ₱{{ number_format($product->price,2) }}
                                </td>
                            </tr>
                            @php
                                $limit++;
                            @endphp
                            @else
                                @break
                            @endif
                        @endforeach
                        @if ($limit == 5)
                            <tr>
                                <td class="text-center truncate whitespace-nowrap" colspan="3">
                                    Click the <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i> Show Details to view all the products!
                                </td>
                            </tr>
                        @endif
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
        <div class="px-5 py-5 text-lg bg-gradient-to-r from-slate-50 via-white to-slate-100">
            <img alt="Empty Cart" class="block object-scale-down w-full mt-3 max-h-24 sm:hidden" src="{{ asset('dist/images/EmptyCartMobile.svg') }}">
            <p class="text-center sm:text-3xl bold">It's a little empty here, shop now!</p>
            <img alt="Empty Cart" class="hidden object-scale-down w-full mt-3 sm:block max-h-96" src="{{ asset('dist/images/EmptyCart.svg') }}">
        </div>
    @endforelse

    <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {!! $Orders->onEachSide(1)->links() !!}
        </nav>
        <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>25</option>
        </select>
    </div>
</div>
