@extends('layouts.email')

@section('heading')
Did your product arrive?
@stop

@section('heading-accent')
@stop

@section('greeting')
Hi {{ $name }},
@stop

@section('body')
Did your product arrive? It should be there soon!
<br>
<br>
Try it out and login to <a href="http://rayvr.com/login">rayvr.com</a> to leave feedback as soon as you can!
<br>
<br>
You can't get another another promotion until you do!
@stop