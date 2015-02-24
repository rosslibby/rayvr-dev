


---------------------------------------------------------------------
@include('includes.head')

<!-- Page heading -->
<div class="early-signup-header-bg">
	<div class="container">
		<div class="row text-center">

			<!-- Video -->
			@section('video')
			@show

			<hr>
			<br>
			<br>

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

		<div class="row source-sans-pro">
			<!-- Column 1 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-1')
							@section('icon-1')
							@show

							<strong>
							@section('headline-1')
							@show
							</strong>

							<p>
							@section('paragraph-1')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 2 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-2')
							@section('icon-2')
							@show

							<strong>
							@section('headline-2')
							@show
							</strong>

							<p>
							@section('paragraph-2')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 3 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-3')
							@section('icon-3')
							@show

							<strong>
							@section('headline-3')
							@show
							</strong>

							<p>
							@section('paragraph-3')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 4 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-4')
							@section('icon-4')
							@show

							<strong>
							@section('headline-4')
							@show
							</strong>

							<p>
							@section('paragraph-4')
							@show
							</p>
						@show
					</div>
				</div>
			</div>
		</div>
		<hr>
		<br>
		<div class="row source-sans-pro">
			<!-- Column 5 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-5')
							@section('icon-5')
							@show

							<strong>
							@section('headline-5')
							@show
							</strong>

							<p>
							@section('paragraph-5')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 6 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-6')
							@section('icon-6')
							@show

							<strong>
							@section('headline-6')
							@show
							</strong>

							<p>
							@section('paragraph-6')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 7 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-7')
							@section('icon-7')
							@show

							<strong>
							@section('headline-7')
							@show
							</strong>

							<p>
							@section('paragraph-7')
							@show
							</p>
						@show
					</div>
				</div>
			</div>

			<!-- Column 8 -->
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						@section('column-8')
							@section('icon-8')
							@show

							<strong>
							@section('headline-8')
							@show
							</strong>

							<p>
							@section('paragraph-8')
							@show
							</p>
						@show
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- The form -->

<br>
<br>
<hr>
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