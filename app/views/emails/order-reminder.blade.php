@extends('emails.email')

@section('heading')
You're missing out!
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Don't miss out on your first offer- it's totally free!
<br>
Log in to <a href="http://rayvr.com/login">RAYVR</a> to check it out!
<br>
<br> 
Best,
<br>
<br>
<em>RAYVR Team</em>
<br>
<a href="mailto:info@rayvr.com">info@rayvr.com</a>
<br>
<a href="http://rayvr.com">rayvr.com</a>
@stop