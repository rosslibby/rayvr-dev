@extends('includes.user-nav')

@section('content')
<p class="h3 raleway lighter text-center">
	<i class="fa fa-ticket"></i> You need to verify your account before you can proceed.
	<br>
	<br>
</p>

<!-- Description for page -->
		<div class="col-md-12 text-center">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<p class="raleway more-height h5 light">
								<i class="fa fa-envelope"></i> A postcard is on its way to your residence with your verification code.
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
	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				@include('forms.verify.inset-verify')
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