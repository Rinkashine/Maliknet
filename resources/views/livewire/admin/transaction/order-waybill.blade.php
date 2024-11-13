<div>
    @if($orderdetails->status == "Completed" || $orderdetails->status == "Processing" ||  $orderdetails->status == "Packed" ||  $orderdetails->status == "Out For Delivery")
         <a class="btn btn-primary intro-y" href="{{ Route('invoice',$orderdetails->id) }}">Print Waybill</a>
    @endif
</div>
