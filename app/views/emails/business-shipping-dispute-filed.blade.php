@extends('layouts.email')

@section('heading')
Shipping Dispute Filed
@stop

@section('greeting')
Hi {{$name}},
@stop

@section('body')
Your shipping dispute has been filed. We will put a hold on the reimbursement until we have completed our review process.
@stop