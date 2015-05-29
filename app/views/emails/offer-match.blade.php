@extends('layouts.email')

@section('heading')
You have a new promotion!
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
You have a new promotion!
<br>
Log in to <a href="http://rayvr.com/login">rayvr.com</a> to check it out!
<br>
Don't delay! All promotions are available for limited <strong>time</strong> and <strong>quantity</strong> - don't miss out!
@stop