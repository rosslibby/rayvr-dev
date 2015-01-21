@include('includes.head')

@if($errors->any())
	<ul>
		{{ implode('', $errors->all('<li>:message</li>')) }}
	</ul>
@endif

			<div class="early-signup-header-bg">
				<div class="container">

					<div class="row text-center">
						<h3 class="h3-5 fg-scheme-dark">Free Offers. Quality Products.</h3>
					</div>

					<br>

					<div class="row text-center">
						<div class="col-md-6 col-md-offset-3">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<p class="larger lighter">RAYVR connects you with offers for real products that you will love. 100% free.</p>
								</div>
							</div>
						</div>
					</div>

					<br>

				</div>
			</div>


			<br>
			<br>
			<br>
			<br>

			<div class="container text-center">
				<h3>Welcome to RAYVR, {{ $name }}!</h3>
			</div>


			<div class="container">

				<div class="col-lg-9 col-lg-offset-2">
					<div class="col-md-12">
						<div class="alert alert-success lighter col-sm-11">
							<strong>You're all set! </strong>Congratulations, you will be one of the first to know when RAYVR goes live. See you soon!
						</div>
					</div>
				</div>

			</div>


			<br>
			<br>
			<br>
			<br>
			<br>

			<div class="container">
				<div class="row text-center">
					{{ HTML::image('resources/img/logo.png') }}
				</div>
			</div>

			<br>
			<br>
			<br>

			<div class="container">
				<div class="row text-center">
					<p class="h4 fg-scheme-dark"><strong>QUALITY OFFERS. 100% FREE.</p>
					<p class="h3 lighter">Get free stuff delivered straight to your door.</h3>
				</div>
				<div class="row text-center">
					<div class="col-md-4 col-md-offset-4">
						<div class="col-sm-10 col-sm-offset-1">
							<p class="lighter">We match you with offers that will be useful and enjoyable to you by running your interests against targeted product and demographical data.</p>
						</div>
					</div>
				</div>
			</div>

			<br>
			<br>
			<br>
			<br>

@include('includes.foot')