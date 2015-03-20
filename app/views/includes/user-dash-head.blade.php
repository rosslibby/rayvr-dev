<!doctype html>
<html lang="en">
<head>
	<title>RAYVR Dashboard</title>

	<!-- Load styles -->
	@include('includes.styles')

	<!-- In an attempt for AJAX posting... -->
	<meta name="_token" content="{{ csrf_token() }}" />

	<!-- Setting up things -->
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD');
	</script>
</head>
<body>

<div class="header bg-scheme-white">
	<div class="nav navbar-primary navbar-fixed-top bg-scheme-white" role="navigation">
		<div class="container">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-nav">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<strong><a class="navbar-brand fg-scheme-dark" href="/offers/current">{{ HTML::image( 'resources/img/logo.png', 'Get Free Stuff with RAYVR', array('width' => '30', 'class' => 'inline-img') ) }}&nbsp;&nbsp;RAYVR</a></strong>
				</div>
				<div id="top-nav" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-left fg-scheme-black anchor lighter">
						@section('topnav')
						@show
					</ul>
					<div class="col-md-2 navbar-right">
						<div class="col-md-8 col-md-offset-4">
							<a href="/logout" class="navbar-btn btn btn-primary text-right">SIGN OUT</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>