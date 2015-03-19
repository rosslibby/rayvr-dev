<!-- Inline business registration -->
<div class="row inline-sign-up">
	<div class="container">
		{{ Form::open(['route' => 'register.store', 'id' => 'inlineRegistration', 'class' => 'form-inline text-left col-md-12']) }}

		<div class="row">

			<div class="col-md-4 col-md-offset-4 text-center">
				<p class="h3 raleway fg-scheme-white normal">Sign Up Now</p>
			</div>

		</div>

		<div class="row">

			<br>
			<div class="form-group required col-md-4 col-md-offset-4 text-center">
				<div class="input-group col-md-12">
					{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email']) }}
				</div>
			</div>

		</div>

		<div class="row">
			
			<br>
			<div class="form-group required col-md-4 col-md-offset-4 text-center">
				<div class="input-group col-md-12">
					{{ Form::password('password', ['id' => 'password', 'class' => 'form-control inset-form-input', 'placeholder' => 'Password']) }}
				</div>
			</div>

		</div>

		<div class="row">
			<br>
			<div class="form-group col-md-2 col-md-offset-5 text-center">
				<div style="display: none !important;">
					{{ Form::hidden('business', 'false') }}
				</div>
				<div class="input-group col-md-12">
					{{ Form::submit('Register', ['class' => 'btn btn-success col-md-10 col-md-offset-2']) }}
				</div>
			</div>
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