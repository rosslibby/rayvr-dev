@extends('layouts.landing-form')

@section('heading')
Welcome Back
@stop

@section('inset-form-heading')
Sign In
@stop

@section('alternate')
<span class="fg-scheme-white">Don't have an account?</span> {{ HTML::link('/#businessRegistration', 'Sign up here') }}<span class="fg-scheme-white">.</span>
@stop

@section('use-form')
@include('forms.login.inset-login')
@stop