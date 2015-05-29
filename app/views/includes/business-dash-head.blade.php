<!doctype html>
<html lang="en">
<head>
	<title>RAYVR Business Dashboard</title>

	<!-- Load styles -->
	{{ HTML::style( asset( 'resources/css/business/bootstrap.min.css' ) ) }}
	{{ HTML::style( asset( 'resources/css/business/skin-red.css' ) ) }}
	{{ HTML::style( asset( 'resources/css/business/AdminLTE.min.css' ) ) }}
	<!-- {{ HTML::style( asset( 'resources/css/custom.business.css' ) ) }} -->
	{{ HTML::style( asset( 'resources/css/jquery.fs.selecter.css' ) ) }}
	{{ HTML::style( asset( 'resources/css/datepicker.css' ) ) }}
	{{ HTML::style( asset( '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' ) ) }}
	{{ HTML::style( asset( '//fonts.googleapis.com/css?family=Raleway:700,100,400,200' ) ) }}
	{{ HTML::style( asset( '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700' ) ) }}
	{{ HTML::style( asset( 'resources/css/bootstrap-slider.css' ) ) }}
	{{ HTML::script( 'https://js.stripe.com/v2/' ) }}

	<!-- Viewport -->
	<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
	
	<!-- For AJAX posting -->
	<meta name="_token" content="{{ csrf_token() }}" />

	<!-- Setting up things -->
	<script type="text/javascript">
		var stripe_publishable_key = "{{ $_ENV['stripe_publishable_key'] }}";
		Stripe.setPublishableKey(stripe_publishable_key);
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
<body class="skin-red sidebar-mini">