@include('includes.head')

<!-- Page heading -->
<div class="early-signup-header-bg">
	<div class="container">
		<div class="row text-center">
			<h3 class="h3-5 fg-scheme-dark">
			@section('heading')
			@show
			</h3>
		</div>

		<br>

<!-- Description for page -->
		<div class="row text-center">
			<div class="col-md-6 col-md-offset-3">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<p class="larger lighter">
						@section('description')
						@show
						</p>
					</div>
				</div>
			</div>
		</div>

		<br>

	</div>
</div>


<br>
<br>
<br>
<br>

<!-- Content filling the page -->
@section('content')
@show

@include('includes.foot')