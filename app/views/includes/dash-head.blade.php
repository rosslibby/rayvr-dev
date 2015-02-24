<!doctype html>
<html lang="en">
<head>
	<title>RAYVR Business Dashboard</title>

	<!-- Load styles -->
	{{ HTML::style( asset('resources/css/bootstrap.min.css') ) }}
	{{ HTML::style( asset('resources/css/bootflat.css') ) }}
	{{ HTML::style( asset('resources/css/skins/flat/red.css') ) }}
	{{ HTML::style( asset('resources/css/custom.business.css') ) }}
	{{ HTML::style( asset('resources/css/jquery.fs.selecter.css') ) }}
	{{ HTML::style( asset('resources/css/datepicker.css') ) }}
	{{ HTML::style( asset('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css') ) }}
	{{ HTML::style( asset('//fonts.googleapis.com/css?family=Raleway:700,100,400,200') ) }}
	{{ HTML::style( asset('//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700') ) }}
	{{ HTML::script('https://js.stripe.com/v2/') }}

	<!-- In an attempt for AJAX posting... -->
	<meta name="_token" content="{{ csrf_token() }}" />

	<!-- Setting up things -->
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD');
	</script>
</head>
<body>

<nav class="navbar navbar-primary navbar-fixed-top bg-scheme-white">
	<div class="container-fluid">
		<div class="row">
			<div class="navbar-header bg-scheme-gray">
				<div class="col-md-11">
					<div class="row">
						<div class="col-md-11 col-md-offset-1">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav" aria-expanded="false" aria-controls="top-nav">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<strong><a class="navbar-brand fg-scheme-light" href="/">{{ HTML::image( 'resources/img/logo.png', 'Get Free Stuff with RAYVR', array('width' => '30', 'class' => 'inline-img') ) }}&nbsp;&nbsp;RAYVR</a></strong>
						</div>
					</div>
				</div>
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
</nav>