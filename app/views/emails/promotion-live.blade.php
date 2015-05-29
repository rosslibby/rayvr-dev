@extends('layouts.email')

@section('heading')
Your RAYVR Promotion Is Live!
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Your promotion is now live! You can now login to your dashboard to track progress.
<br>
<br>
<strong>Questions?</strong>
<br>
The RAYVR Support Team is here for you! If you have any questions please get in touch and we’ll help you out any way we can.
@stop