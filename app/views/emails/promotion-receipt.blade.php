@extends('layouts.email')

@section('heading')
Your RAYVR Payment
@stop

@section('greeting')
Your payment was successful for ${{ $amount }} amount for the RAYVR promotion ID: {{ $promo_id }}.
@stop

@section('body')
This payment includes the number of promotions that were accepted by our users, and any shipping charges that our users were reimbursed.
<br>
This will appear on your credit card as {{ $description }} {{ $promo_id }}.
<br> 
<br>
Thank you for being part of RAYVR!
@stop