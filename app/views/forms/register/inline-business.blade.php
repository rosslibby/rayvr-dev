<!-- Inline business registration -->
<hr>
<div class="row">
	{{ Form::open(['route' => 'register.store', 'id' => 'businessRegistration', 'class' => 'form-inline text-left']) }}

		<div class="form-group required col-md-5">
			<div class="input-group col-md-12">
				{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email')) }}
			</div>
		</div>
		
		<div class="form-group required col-md-5">
			<div class="input-group col-md-12">
				{{ Form::password('password', array('id' => 'password', 'class' => 'form-control inset-form-input', 'placeholder' => 'Password')) }}
			</div>
		</div>

		<div class="form-group col-md-2">
			<div style="display: none !important;">
				{{ Form::hidden('business', 'true') }}
			</div>
			<div class="input-group col-md-12">
				{{ Form::submit('Register', array('class' => 'btn btn-success col-md-10 col-md-offset-2')) }}
			</div>
		</div>

	{{ Form::close() }}
</div>
<br>
<p class="source-sans-pro normal text-right">By registering, you agree to abide by our {{ HTML::link('resources/terms-and-conditions', 'Terms and conditions', ['target' => '_blank']) }}</p>
<hr>