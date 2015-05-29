{{-- HTML head --}}
@include('includes.business-dash-head')

{{-- Content --}}
<div class="wrapper" style="min-height:800px">

	{{-- Navigation --}}
	@include('includes.business-dash-nav')

	{{-- Sidebar --}}
	@include('includes.business-dash-sidebar')

	<!-- Main content -->
	<div class="content-wrapper">
		@section('content')
			{{-- Main dashboard content --}}
		@show
	</div>
</div>

{{-- Footer --}}
@include('includes.business-dash-foot')