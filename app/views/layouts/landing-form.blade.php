@include('includes.head')

<!-- Page heading -->
<div class="early-signup-header-bg">
	<div class="container">
		<div class="row text-center">

			<div class="col-md-10 col-md-offset-1">
				<!-- Video -->
				@section('video')
				@show
			</div>
		</div>
	</div>
	<div class="col-md-12" id="pageInfo">
		<br>
		@section('use-inline-form')
		@show
		@if(Session::has('error'))
			<br>
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				{{ Session::get('error') }}
				<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
			</div>
		@endif
	</div>
	<div class="container">
		<div class="row text-center">

			<p class="h6 raleway fg-scheme-dark">
			@section('pre-heading')
			@show
			</p>

			<p class="h3 raleway lighter" style="font-weight: 200;">
			@section('heading')
			@show
			</p>
		</div>

<!-- Description for page -->

		<div class="row text-center">
			<div class="col-md-6 col-md-offset-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<p class="raleway more-height">
						@section('description')
						@show
						</p>
					</div>
				</div>
			</div>
		</div>

		<br>
		<br>
		<br>

		@section('use-grid')
		@show

	</div>
</div>

<!-- The form -->

<br>
<br>
<br>
<div class="inset-form-container row-dark-blue">
	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<div class="row text-center">
			<div class="col-md-10 col-md-offset-1">
				<h3 class="inset-form-heading">
					@section('inset-form-heading')
					@show
				</h3>
			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				@section('use-form')
				@show
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
					</div>
				@endif
				<div class="text-center">
					@section('alternate')
					@show
				</div>
			</div>
		</div>
		<br>
		<br>
	</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

@include('includes.foot')