@extends('layouts.landing-form')

@section('heading')
Sign in to your account.
@stop

@section('description')
Manage your offers, preferences, and score in your RAYVR dashboard.
@stop

@section('inset-form-heading')
Sign in to your User or Business cccount
@stop

@section('use-form')
@include('forms.login.inset-login')
@stop