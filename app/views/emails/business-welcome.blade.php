@extends('layouts.email')

@section('heading')
Welcome to 
@stop

@section('heading-accent')
RAYVR
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Thank you for joining RAYVR, your account is now active.
<br>
If you have any questions, please reply to this email and we will reply to you as soon as possible.
<br>
To submit a new promotion, <a href="https://rayvrbusiness.com/offers/add">Start Here</a>
<br> 
<br>
Kind regards,
<br>
<br>
<em>The RAYVR Business Team</em>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
<br>
<a href="https://rayvrbusiness.com">https://rayvrbusiness.com</a>
@stop