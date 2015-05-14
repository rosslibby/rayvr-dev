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
<br>
<br> 
Cheers,
<br>
<br>
<em>The RAYVR Team</em>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
RAYVR
<br>
<a href="https://rayvrbusiness.com">https://rayvrbusiness.com</a>
@stop