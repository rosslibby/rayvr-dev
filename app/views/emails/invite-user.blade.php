@extends('layouts.email')

@section('heading')
You're Invited
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
{{ $firstName }} invited you to join RAYVR.
<br>
Join the only program that connects you with high quality FREE products - all we need is your feedback.
<br>
Sign up today to be matched with your first promotion:
<br>
<a href="http://rayvr.com/register/{{ $code }}" class="underline btn btn-success">Join RAYVR Today</a>
@stop