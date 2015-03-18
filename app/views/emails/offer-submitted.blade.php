@extends('emails.email')

@section('heading')
Your offer has been submitted
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Thanks for submitting your  offer. it will be reviewedto be sure it meets our guidelines and doesn't conflict with any other offers current in our program.
<br>
You should hear back from us within 48 hours. If approved, we will order samples of your product for testing before final approval.
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
<br> 
Best,
<br>
<br>
<em>RAYVR Business Team</em>
<br>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
RAYVR
<br>
<a href="http://rayvr.com">www.rayvr.com</a>
@stop