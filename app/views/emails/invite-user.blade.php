@extends('layouts.email')

@section('heading')
You're
@stop

@section('heading-accent')
Invited
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
{{ $firstName }} invited you to join RAYVR.
<br>
Join the only program that connects you with high quality FREE products - all we need is your feedback.
<br>
Sign up today to be matched with your first product offer:
<br>
<a href="http://rayvr.com/{{ $code }}" class="underline btn btn-success">Join RAYVR Today</a>
<br>
<br>
<em>The RAYVR team</em>
<br>
<a href="mailto:info@rayvr.com">info@rayvr.com</a>
@stop