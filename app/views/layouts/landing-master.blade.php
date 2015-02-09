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
		@section('row-one')
		@show
		</div>
		<hr>
		<br>
		<div class="row source-sans-pro">
		@section('row-two')
		@show
		</div>

	</div>
</div>

<!-- Content filling the page -->
@section('content')
@show
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