@extends('includes.user-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<!-- Heading -->
		<div class="row">
			<div class="text-center">
				@if(Session::has('success'))
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
						<strong>Success:</strong> {{ Session::get('success') }}
					</div>
					<br>
				@endif
			</div>
		</div>
	</div>
</div>
@stop


@section('out-container')
<div class="inset-form-container row-dark-blue">
	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<br>
		<h1 class="raleway fg-scheme-white text-center">Contact RAYVR Support</h1>
		<br>
		<p class="fg-scheme-white light h5 text-center">Or visit our {{ HTML::link('faq', 'FAQs', ['target' => '_blank']) }}</p>
		<br>
		<div class="row">
			<div class="col-md-12">
				@include('forms.contact.inset-contact')
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop