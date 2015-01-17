@include('includes.head')

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
				<h3>Sign up now for early access</h3>
			</div>

			<br>


				<div class="container">

					<div class="col-md-8 col-md-offset-2">
						{{ Form::open(array('class' => 'form')) }}

							<div class="col-md-9">
								{{ Form::email('email', $value = null, array('class' => 'form-control', 'placeholder' => 'Enter your email')) }}
							</div>
							<div class="col-md-3">
								{{ Form::submit('SIGN UP', array('class' => 'btn btn-primary col-md-12')) }}
							</div>

						{{ Form::close() }}
					</div>

				</div>


		<br>


		<div class="container">

			<div class="col-lg-9 col-lg-offset-2">
				<div class="col-md-12">
					<div class="alert alert-success lighter col-sm-11">
						<strong>RAYVR is Anti-Spam: </strong>We won't spam you or sell your email. We will use this to notify you once RAYVR is live.
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