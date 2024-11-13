<div>
    <div class="intro-y box p-5">
        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
        <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <a href="{{ url()->previous() }}" class="mr-2 btn">←</a> Adjustment History - {{ $product_name }}  </div>
                <!-- Product Title -->
                <div class="overflow-x-auto scrollbar-hidden">
                    <div class="overflow-x-auto">
                        <table class="table table-striped mt-5 table-bordered table-hover" id="datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="whitespace-nowrap ">Date</th>
                                    <th class="whitespace-nowrap text-center">Activity</th>
                                    <th class="whitespace-nowrap text-center">Adjusted by</th>
                                    <th class="whitespace-nowrap text-center">Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventory_logs as $logs)
                                <tr>
                                    <td>{{ $logs->created_at->toDayDateTimeString() }}</td>
                                    <td  class="whitespace-nowrap text-center">{{ $logs->activity }}
                                        @if(!empty( $logs->purchase_order_id))
                                            <a href="{{ Route('transfer.show',$logs->purchase_order_id) }}">{{ $logs->purchase_order_id }}</a>
                                        @elseif(!empty($logs->customer_order_id ))
                                            <a href="{{ Route('orders.show',$logs->customer_order_id) }}">{{ $logs->customer_order_id }}</a>
                                        @endif
                                    </td>
                                    <td  class="whitespace-nowrap text-center">{{ $logs->adjusted_by }}</td>
                                    <td  class="whitespace-nowrap text-center"><span class="text-slate-500">{{ $logs->operation_value }}</span> {{ $logs->latest_value }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Adjustments Made</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END: Product Title -->
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-5">
                    <nav class="w-full sm:w-auto sm:mr-auto">
                        {!! $inventory_logs->onEachSide(1)->links() !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
