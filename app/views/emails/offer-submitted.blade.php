@extends('layouts.email')

@section('heading')
Your promotion has been submitted
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Thanks for submitting your promotion. it will be reviewed to be sure it meets our guidelines and doesn't conflict with any other promotions current in our program.
<br>
<br>
You should hear back from us within 48 hours. If approved, we will order samples of your product for testing before final approval.
<br>
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
@stop