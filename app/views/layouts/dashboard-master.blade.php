@include('includes.dash-head')

<!-- Sidebar -->

<div class="container-fluid">
	<div class="row">
		<div class="sidebar">

			<ul class="nav nav-sidebar anchor light">
				@section('sidebar')
				@show
			</ul>

		</div>

		<!-- Content area -->

		<div class="content-area">
			@section('contentarea')
			@show
			
			<!-- Content filling the page -->
			@section('content')
			@show
		</div>

	</div>
</div>

@include('includes.dash-foot')