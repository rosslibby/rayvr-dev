@extends('layouts.email')

@section('heading')
New RAYVR Promotion
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
You have a new promotion!
<br>
<br>
Log in to <a href="https://rayvr.com/login">rayvr.com</a> to check it out!
@stop