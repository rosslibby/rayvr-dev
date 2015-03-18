@extends('emails.email')

@section('heading')
Did your product arrive?
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Did your product arrive? Use it and login to <a href="http://rayvr.com/login">rayvr.com</a> to leave feedback as soon as you can!
<br>
Our speediest members get the best new offers!
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