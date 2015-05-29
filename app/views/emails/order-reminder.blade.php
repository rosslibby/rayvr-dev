@extends('layouts.email')

@section('heading')
You're missing out!
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
Don't miss out on your first promotion - it's totally free!
<br>
Log in to <a href="http://rayvr.com/login">rayvr.com</a> to check it out!
@stop