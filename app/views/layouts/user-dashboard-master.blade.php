@include('includes.user-dash-head')

<!-- Sidebar -->

<div class="container container-fluid">
	<div class="row">

		<!-- Content area -->

		<div class="content-area">
			
			<!-- Content filling the page -->
			@section('content')
			@show
		</div>

	</div>
</div>
@section('out-container')
@show

@include('includes.dash-foot')