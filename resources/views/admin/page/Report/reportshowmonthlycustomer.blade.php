@extends('admin.layout.admin')
@section('content')
@section('title', 'Monthly Customer')

@livewire('report.monthly-customer-show',[
    'from' => $from,
    'to' => $to,
    'month' => $month,
    'year' => $year])


@endsection
