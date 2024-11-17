<!DOCTYPE html>
<html>
<head>
    <title>Receipt for #{{ $orderdetails->id }}</title>
</head>
<style type="text/css">
@page { margin: 5px 5px 30px; }
#footer {
    position: fixed;
    left: 20px;
    bottom: 0;
    text-align: center;
    }
#footer .page:after {
    content: counter(page);
}
    body{
        font-family: 'Open Sans Condensed', sans-serif;
    }
    .mt-10{
        margin-top: 2.5rem;
    }
    .text-light{
        font-weight: 300;
    }
    .text-right{
        text-align: right;
    }
    .text-left{
        text-align: left;
    }
    .text-center{
        text-align: center;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .pt-x-50{
        padding-top:50px;
        padding-bottom:50px;
        padding-left:50px;
        padding-right:50px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .w-85{
        width:85%;
    }
    .w-80{
        width:80%;
    }
    .w-30{
        width:30%;
    }
    .w-15{
        width:15%;
    }
    img{
        width:100px;
        height:100px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .text-white{
        color: white;
    }
    .border{
        border:1px solid black;
    }
    .th-color-dark{
        background-color: #327e62;
    }
    table tr,th,td{
        border: 0px solid black;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .stripe:nth-child(odd) {
        background-color: #cddbd7 ;
    }
    .stripe:nth-child(even) {
        background-color: #f8fafc ;
    }
</style>
<body class="pt-x-50">
    <main>
        <div class="mt-10 add-detail">
            <div class="float-left mt-10 w-50">
                <img src="{{ public_path('dist/images/MaliknetLogo.jpg') }}" alt="Logo">
            </div>
            <div class="float-left mt-10 text-right start w-50">
                <p class="gray-color">#{{ $orderdetails->id }}</p>
                <p class="gray-color">{{ $orderdetails->created_at->toFormattedDateString() }}</p>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="mt-10 table-section bill-tbl w-100">
            <table class="table mt-10 w-100">
                <tr class="text-white">
                    <th class="w-50 th-color-dark">Shipping Address</th>
                    <th class="w-50 th-color-dark">Customer</th>
                </tr>
                <tr>
                    <td>
                        <div class="box-text">
                            <p>{{ $orderdetails->received_by }},</p>
                            <p>{{ $orderdetails->house }},</p>
                            <p>{{ $orderdetails->city }}</p>
                            <p>Contact: {{ $orderdetails->phone_number }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="box-text">
                            <p>{{ $orderdetails->customers->name }}</p>
                            <p>Email: {{ $orderdetails->customers->email }}</p>
                            <p>Contact: {{ $orderdetails->customers->phone_number }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="mt-10 table-section bill-tbl w-100">
            <table class="table mt-10 w-100">
                <thead>
                    <tr class="text-white">
                        <th class="w-50 th-color-dark">Product Name</th>
                        <th class="w-50 th-color-dark">Price</th>
                        <th class="w-50 th-color-dark">Qty</th>
                        <th class="w-50 th-color-dark">Total</th>
                    </tr>
                </thead>
               <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach($orderdetails->orderTransactions as $order)
                    <?php $total += $order->quantity * $order->price ?>
                    <tr class="stripe">
                        <td>{{ $order->product_name }}</td>
                        <td class="text-center" style="font-family: DejaVu Sans; font-size: 0.8rem;">&#x20B1;{{ number_format($order->price,2) }}</td>
                        <td class="text-center">{{ number_format($order->quantity) }}</td>
                        <td class="text-center" style="font-family: DejaVu Sans; font-size: 0.8rem;">&#x20B1;{{ number_format($order->price * $order->quantity ,2)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <div class="mt-10 table-section bill-tbl w-100">
                    <table class="table mt-10 w-100">
                        <tr>
                            <td colspan="7">
                                <div class="total-part">
                                    <div class="float-left total-left w-80" align="right">
                                        <p>Total:</p>
                                        <p>Shipping Fee:</p>
                                        <p>Total Payable:</p>
                                    </div>
                                    <div class="float-left total-right w-15" align="right">
                                        <p style="font-family: DejaVu Sans; font-size: 0.8rem;">&#x20B1;{{ number_format($total,2) }}</p>
                                        <p style="font-family: DejaVu Sans; font-size: 0.8rem;">&#x20B1;100</p>
                                        <p style="font-family: DejaVu Sans; font-size: 0.8rem;">&#x20B1;{{ number_format($total + 100,2) }}</p>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </main>
    <footer class="mt-10 text-center">
        <p class="">Thank you for shopping with us!</p>
        <p class="text-bold">GoDental</p>
    </footer>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                 if ($PAGE_COUNT > 1) {
                     $font = $fontMetrics->getFont("Lato", "regular");
                     $pdf->page_text(522, 770, "Page {PAGE_NUM} / {PAGE_COUNT}", $font, 12, array(.5,.5,.5));
                }
            ');
       }
    </script>
</html>
