@extends('admin.layout.admin')
@section('content')
@section('title', 'Monthly Order Cancellations')

@livewire('report.monthly-cancellation',[
    'from' => $from,
    'to' => $to,
    'month' => $month,
    'year' => $year])


@endsection
