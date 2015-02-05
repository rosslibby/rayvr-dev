@extends('layouts.landing-master')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/118826532' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
<hr>
@stop

@section('heading')
Free Offers. Quality Products.
@stop

@section('description')
RAYVR connects you with offers for real products that you will love. 100% free.
@stop

@section('content')
			<div class="container text-center">
				<h3>Sign up now for early access</h3>
			</div>

			<br>


				<div class="container">

					<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">

						{{ Form::open(array('route' => 'register.earlystore')) }}

							<div class="col-md-9 col-sm-9">
								{{ Form::email('email', $value = null, array('class' => 'form-control', 'placeholder' => 'Enter your email')) }}
							</div>

							{{ Form::text('password', $value = 'password', array('class' => 'hidden-input')) }}

							{{ Form::text('business', $value = 'no', array('class' => 'hidden-input')) }}

							{{ Form::text('invited_by', $value = $referral['referral'], array('class' => 'hidden-input')) }}

							<div class="col-md-3 col-sm-3">
								{{ Form::submit('SIGN UP', array('class' => 'btn btn-primary col-md-12 col-sm-12')) }}
							</div>

						{{ Form::close() }}
					</div>

				</div>


		<br>


		<div class="container">

			<div class="col-lg-9 col-sm-9 col-lg-offset-2 col-sm-offset-2">
				<div class="col-md-12 col-xs-12">
					<div class="alert alert-success lighter col-sm-11 col-xs-11">
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
				<p class="h3 lighter">Get free stuff delivered straight to your door.</p>
			</div>
			<div class="row text-center">
				<div class="col-md-4 col-md-offset-4">
					<div class="col-sm-10 col-sm-offset-1">
						<p class="lighter">We match you with offers that will be useful and enjoyable to you by running your interests against targeted product and demographical data.</p>
					</div>
				</div>
			</div>
		</div>
@stop