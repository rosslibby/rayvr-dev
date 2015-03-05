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