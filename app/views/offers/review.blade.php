@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		@if(Session::has('success'))
		<div class="row">
			<div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>Success: </strong>
				{{ Session::get('success') }}
			</div>
		</div>
		@endif
		<div class="text-center">
			<h2 class="fg-scheme-white">We are reviewing your offer and will be in contact shortly.</h2>
		</div>
	</div>
@stop

@section('content')
	<br>
	<div class="col-md-8 col-md-offset-2">
		<p class="h3 raleway">Sit tight, we are reviewing your offer.</p>
		<p>We will get back to you very soon!</p>
		<p>Why are we reviewing your offer? We want to make sure that it meets our standards as outlined in our {{ HTML::link('resources/terms-and-conditions', 'Terms &amp; Conditions', ['target' => '_blank']) }}, and that no other similar offers currently exist in our database.</p>
	</div>
@stop