@include('includes.dash-head')

<!-- Sidebar -->

<div class="container-fluid">
	<div class="row">
		<div class="sidebar bg-scheme-gray">

			<ul class="nav nav-sidebar fg-scheme-gray anchor heavier">
				@section('sidebar')
				@show
			</ul>

		</div>

		<!-- Content area -->

		<div class="content-area">
			@section('contentarea')
			@show
		</div>

	</div>
</div>

<!-- Content filling the page -->
@section('content')
@show

@include('includes.dash-foot')