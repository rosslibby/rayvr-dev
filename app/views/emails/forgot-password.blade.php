@extends('layouts.email')

@section('heading')
Password 
@stop

@section('heading-accent')
Reset
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
<strong>We received a request to reset your password.</strong>
If you believe you have received this message in error, please take no action.
<br>
If you wish to reset your password, please use the following link: <a href="{{ $link }}">{{ $link }}</a>
<br>
<br>
<em>RAYVR Support</em>
<br>
<br>
<a href="mailto:support@rayvr.com">support@rayvr.com</a>
@stop