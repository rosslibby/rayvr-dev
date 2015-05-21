@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
<div class="row text-center">
	<p class="h6 raleway fg-scheme-dark">
	RAYVR Customer Support
	</p>
	<p class="h3 raleway lighter" style="font-weight: 200;">
	We're here to help
	</p>
</div>
<!-- Description for page -->
		<div class="col-md-12 text-center">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<p class="raleway more-height h5 light">
								<h1><i class="fa fa-mobile-phone larger"></i></h1>
								<p class="h3">+1 (888) 842 - 5754</p>
								<h1><a href="mailto:support@rayvr.com"><i class="fa fa-envelope larger"></i></a></h1>
								<p class="h3">Support</p>
								<!-- <h1><i class="fa fa-life-ring larger"></i></h1>
								<p class="h3">{{ HTML::link('faq', 'FAQ') }}</p> -->
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- The form -->

<br>
<br>
<br>
@stop

@section('out-container')
<div class="inset-form-container row-dark-blue">
	<div class="col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">
		<br>
		<div class="row">
			<div class="col-md-12">		
			<div class="row text-center">
			<div class="col-md-10 col-md-offset-1">
				<h3 class="inset-form-heading">
				Contact RAYVR Support
				</h3>
			</div>
			</div>
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong>
					</div>
				@endif
				@if(Session::has('success'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('success') }}
						<strong>Thank you</strong>
					</div>
				@endif
				@include('forms.contact.inset-contact')
			</div>
		</div>
	</div>
</div>
@stop

{{-- @section('inset-form-heading')
Contact RAYVR Support
@stop

@section('use-form')
@include('forms.contact.inset-contact')
@stop --}}