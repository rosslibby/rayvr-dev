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

		<!-- Jumbotron -->

		<div class="content-area">
			{{ HTML::image( 'resources/img/business/ad/35-percent-off.png', 'Get 35% Off Your Next Order of 50 Offers Or More', array('width' => '1000') ) }}
		</div>

	</div>
</div>

@include('includes.dash-foot')