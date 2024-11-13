<!DOCTYPE html>
<html>
<head>
    <title>Most Visited Page</title>
</head>
<style type="text/css">
    @page {
        margin: 0px 0px 0px 0px;

        }
    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 3.5cm;
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 12pt;
        margin-bottom: 2cm;
    }

    /** Define the header rules **/
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;

        /** Extra personal styles **/
        text-align: center;
    }

    .header-title {
        margin: 0;
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
        border: 1px solid black;
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
    <header class="header">
        <div style="position: absolute; top:25px; left:40px">
            <img style="width:100px; height:100px;" src="{{ public_path('dist/images/MainLogo.png') }}" alt="Logo">
        </div>
        <div class="w-100" style="padding: 20px; ">
                <h2 class="">Roman Dental Supplies Trading</h2>
                    <div style="margin: auto; width: 30%;">
                        <h5 class="text-left header-title">Address: Grand Royale Subdivision</h5>
                        <h5 class="text-left header-title">Contact No: +639 (612) 126 52</h5>
                    </div>
                <div style="clear: both;"></div>
        </div>
        <hr>
    </header>
    <main>
        <div class="w-100" style="margin-bottom:10px">
            <div>
                <h3 class="text-center header-title">Most Visited Page </h3>
                <h5 class="text-center header-title">From: {{ $from }} - To: {{ $to }}</h5>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div>
            <table class="table w-100">
                <thead>
                    <tr class="text-white">
                        <th class="w-50 th-color-dark">Url</th>
                        <th class="w-50 th-color-dark">Title</th>
                        <th class="w-50 th-color-dark">Sessions</th>
                    </tr>
                </thead>
               <tbody>
                    @foreach($pages as $page)
                        <tr class="stripe">
                            <td class="text-center">{{{  env('APP_URL').$page['url'] }}}</td>
                            <td  class="text-center">{{  $page['pageTitle'] }}</td>
                            <td  class="text-center">{{   number_format($page['pageViews']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
    <footer class="mt-10 text-left">
        <p class="">Prepared By: {{ $prepared_by }}</p>
    </footer>
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                 if ($PAGE_COUNT > 1) {
                     $font = $fontMetrics->getFont("helvetica", "regular");
                     $pdf->page_text(522, 770, "Page {PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0,0,0));
                }
            ');
       }
    </script>
</html>
