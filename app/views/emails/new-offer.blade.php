@extends('layouts.email')

@section('heading')
You have a 
@stop

@section('heading-accent')
new offer!
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
You have a new offer!
<br>
Log in to <a href="http://rayvr.com/login">rayvr.com</a> to check it out!
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