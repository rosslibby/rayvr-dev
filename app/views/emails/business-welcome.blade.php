@extends('layouts.email')

@section('heading')
Welcome to RAYVR
@stop

@section('heading-accent')
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
Thank you for joining RAYVR, your account is now active.
<br>
<br>
If you have any questions, please email us at {{ HTML::link('mailto:support@rayvr.com', 'support@rayvr.com') }} and we will reply to you as soon as possible.
@stop