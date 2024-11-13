
<div class="box p-5 rounded-md">
    <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
        <div class="font-medium text-base truncate">Transaction Details</div>
        <!-- BEGIN: CHANGE ORDER STATUS -->
        @if($status != "Pending for Approval")
            <button wire:click="selectItem({{$order_id}},'changeorderstatus')" class="flex items-center ml-auto text-primary"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Change Status </button>
        @endif
        <!-- END: CHANGE ORDER STATUS -->
    </div>
    <div class="flex items-center">
        <i class="fa-regular fa-rectangle-list text-slate-500 mr-2"></i>
        Order ID:
        <div class="underline decoration-dotted ml-1">#{{ $order_id }}</div>
    </div>
    <div class="flex items-center mt-3">
        <i class="fa-regular fa-calendar  text-slate-500 mr-2"></i>
         Purchase Date: {{$created_at->toFormattedDateString() }}
    </div>
    <div class="flex items-center mt-3">
        <i class="fa-solid fa-timeline text-slate-500 mr-2"></i>
        Transaction Status:
        @if($status == "Completed" || $status == "Delivered")
            <span class="bg-success/20 text-success rounded px-2 ml-1">{{ $status }}</span>
        @else
            <span class="bg-warning  rounded px-2 ml-1">{{ $status }}</span>
        @endif
        </div>
</div>

