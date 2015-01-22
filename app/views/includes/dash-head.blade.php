<!doctype html>
<html lang="en">
<head>
	<title>RAYVR Business Dashboard</title>

	<!-- Load styles -->
	{{ HTML::style( asset('resources/css/bootstrap.min.css') ) }}
	{{ HTML::style( asset('resources/css/bootflat.css') ) }}
	{{ HTML::style( asset('resources/css/skins/flat/red.css') ) }}
	{{ HTML::style( asset('resources/css/custom.business.css') ) }}
</head>
<body>

<nav class="navbar navbar-primary navbar-fixed-top bg-scheme-white">
	<div class="container-fluid">
		<div class="row">
			<div class="navbar-header bg-scheme-gray">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-nav" aria-expanded="false" aria-controls="top-nav">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<strong><a class="navbar-brand fg-scheme-light" href="#">{{ HTML::image( 'resources/img/logo.png', 'Get Free Stuff with RAYVR', array('width' => '30', 'class' => 'inline-img') ) }}&nbsp;&nbsp;RAYVR</a></strong>
			</div>
			<div id="top-nav" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left fg-scheme-black anchor lighter">
					<li><a href="/new-offer">Add Offer</a></li>
					<li><a href="/track-offers">Track Offers</a></li>
					<li><a href="/shipping-claims">Shipping Claims</a></li>
					<li><a href="/purchase-offers">Purchase Offers</a></li>
					<li><a href="/preferences">Preferences</a></li>
				</ul>
				<div class="col-md-2 navbar-right">
					<div class="col-md-8 col-md-offset-4">
						<button class="navbar-btn btn btn-primary text-right">SIGN OUT</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>