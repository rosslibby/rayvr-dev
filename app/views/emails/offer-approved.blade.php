@extends('layouts.email')

@section('heading')
Your offer has been approved!
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Your product has passed our initial screening and will be able to hold product exclusivity for category: {{ $category }}
<br>
At this point we will use the voucher code you provided to order 3 of your products for quality testing before final approval.
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
<br>
<br>
Best,
<br>
<br>
RAYVR Business Team
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
RAYVR
<br>
<a href="http://rayvr.com">www.rayvr.com</a>
@stop