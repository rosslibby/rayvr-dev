<!-- Inline business registration -->
<div class="row inline-sign-up">
	<div class="container col-md-10 col-md-offset-1">

		<div class="row">

			<div class="text-center">
				<p class="h3 raleway fg-scheme-white normal">Sign Up Now</p>
			</div>

		</div>

		{{ Form::open(['route' => 'register.store', 'id' => 'inlineRegistration', 'class' => 'col-md-8 col-md-offset-2']) }}

			<div class="form-group required">
				{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email']) }}
			</div>

			<div class="form-group required">
				{{ Form::password('password', ['id' => 'password', 'class' => 'form-control inset-form-input', 'placeholder' => 'Password']) }}
			</div>

			<div class="form-group text-right">
				{{ Form::hidden('business', 'false') }}
				{{ Form::submit('Register', ['class' => 'btn btn-success']) }}
			</div>

		{{ Form::close() }}
	</div>
</div>
<br>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<p class="source-sans-pro normal text-right">By registering, you agree to abide by our {{ HTML::link('resources/terms-and-conditions', 'Terms and conditions', ['target' => '_blank']) }}</p>
		</div>
	</div>
</div>
<hr>