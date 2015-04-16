<!doctype html>
<html lang="en">
<head>
	<title>RAYVR Dashboard</title>

	<!-- Load styles -->
	@include('includes.styles')

	<!-- Viewport -->
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

	<!-- For AJAX posting... -->
	<meta name="_token" content="{{ csrf_token() }}" />

	<!-- Open Graph tags -->
	<meta property="og:url"					content="http://rayvr.com/register/{{ Auth::user()->invite_code }}" />
	<meta property="fb:app_id"				content="366410603565006" />
	<meta property="og:type"				content="business" />
	<meta property="og:title"				content="Quality Products. 100% Free." />
	<meta property="og:description"			content="Get Free Stuff Just for Signing Up With RAYVR" />
	<meta property="og:video"				content="https://player.vimeo.com/video/118826532" />
	<meta property="og:video:url"			content="https://player.vimeo.com/video/118826532" />
	<meta property="og:video:secure_url"	content="https://player.vimeo.com/video/118826532" />
	<meta property="og:video:width"			content="945" />
	<meta property="og:video:height"		content="532" />

	<!-- Setting up things -->
	<script type="text/javascript">
		Stripe.setPublishableKey('pk_test_X8GEnzu7zmgQ1N62Nr3W5vqD');
	</script>

	<!-- GA -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-61914678-1', 'auto');
	ga('send', 'pageview');

	</script>
</head>
<body>

<!-- Facebook SDK -->
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId: '366410603565006',
			xfbml: true,
			version: 'v2.3'
		});

		$("#share").click(function(e){
			// necessary to keep the cog from spinning on the "send invite" button
			e.preventDefault();
			FB.ui({
				method: 'feed',
				link: 'https://rayvr.com/register/<?php echo Auth::user()->invite_code; ?>',
				name: 'Get Free Stuff Just for Signing Up With RAYVR',
				caption: 'Quality Products. 100% Free.',
				description: 'Get products you\'ll use everyday completely free! RAYVR connects you with great products to try out and keep forever. Signing up is quick and easy. Join today.',
				picture: 'https://rayvr.com/resources/img/logo.png',
			}, function(response){});
		});
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<div class="header bg-scheme-white">
	<div class="nav navbar-primary navbar-fixed-top bg-scheme-white" role="navigation">
		<div class="container">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" id="navbar-toggle" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav" aria-expanded="false">
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