@extends('layouts.landing-contact')

@section('pre-heading')
RAYVR Customer Support
@stop

@section('heading')
We're here to help
@stop

	<!-- Column 1 -->
	@section('column-1')
		@section('icon-1')
		<h1><i class="fa fa-mobile-phone larger"></i></h1>
		@stop

		@section('headline-1')
		<p class="h3">+1 (888) 842 - 5754</p>
	@stop

	<!-- Column 2 -->
	@section('column-2')
		@section('icon-2')
		<h1><i class="fa fa-envelope larger"></i></h1>
		@stop

		@section('headline-2')
		<p class="h3">Support</p>
	@stop

	<!-- Column 3 -->
	@section('column-3')
		@section('icon-3')
		<h1><i class="fa fa-life-ring larger"></i></h1>
		@stop

		@section('headline-3')
		<p class="h3">FAQ</p>
	@stop

@section('inset-form-heading')
Contact RAYVR Support
@stop

@section('use-form')
@include('forms.contact.inset-contact')
@stop