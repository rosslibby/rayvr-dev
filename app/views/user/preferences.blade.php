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
				<h3>Just a few more details...</h3>
			</div>

			<br>


				<div class="container">

					<div class="col-md-12">

						{{ Form::open(array('route' => 'user.store')) }}

							<div class="col-md-10 col-md-offset-1">
								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										{{ Form::text('first_name', $value = null, array('class' => 'form-control', 'placeholder' => 'Your first name')) }}
									</div>
								</div>

								<br>

								<div class="row">
									<div class="col-md-10 col-md-offset-1">
										{{ Form::text('last_name', $value = null, array('class' => 'form-control', 'placeholder' => 'Your last name')) }}
									</div>
								</div>

								<br>
								<br>

								<div class="row">

									<div class="col-md-11 col-md-offset-1">

										@foreach ($interests as $interest)
											<div class="col-md-4">
												<div class="checkbox">
													{{ Form::checkbox('interest[]', $value = $interest['id'], null, array('id' =>  'interest_'.$interest['id'], 'class' => 'form-control')) }}
													{{ Form::label('interest_'.$interest['id'], $interest['title'], array('id' => 'interest_'.$interest['id'])) }}
												</div>
											</div>
										@endforeach

									</div>

								</div>

								<br>
								<br>

								<div class="row">
									<div class="col-md-3 col-md-offset-8 text-right">
										{{ Form::submit('SAVE PREFERENCES', array('class' => 'btn btn-primary')) }}
									</div>
								</div>

							</div>

						{{ Form::close() }}
					</div>

				</div>


		<br>


		<div class="container">

			<div class="col-lg-9 col-lg-offset-2">
				<div class="col-md-12">
					<div class="alert alert-success lighter col-sm-11">
						<strong>Why the questions? </strong>Your answers help <em>us</em> match <em>you</em> with offers for free products that you will enjoy.
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