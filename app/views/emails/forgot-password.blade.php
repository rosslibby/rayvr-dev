@extends('layouts.email')

@section('heading')
Password 
@stop

@section('heading-accent')
Reset
@stop

@section('greeting')
@stop

@section('body')
You have requested to reset your password. To reset your password, click on the link below. 
<br>
<a href="{{ $link }}">{{ $link }}</a>
<br>
If you did not request to reset your password, please disregard this email.
<br>
For further support, please contact us: 
<br>
<em>RAYVR Support</em>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
@stop