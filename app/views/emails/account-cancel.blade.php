@extends('layouts.email')

@section('heading')
Account Deactivated
@stop

@section('greeting')
Hello {{ $name }},
@stop

@section('body')
We’re sorry to see you go! If you have any questions please do not hesitate to reach out.
@stop