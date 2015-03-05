<!-- User registration -->
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['route' => 'register.store', 'id' => 'businessRegistration']) }}

			<div class="form-group required">
				<div class="input-group">
					{{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email')) }}
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
			
			<div class="form-group required">
				<div class="input-group">
					{{ Form::password('password', array('id' => 'password', 'class' => 'form-control inset-form-input', 'placeholder' => 'Password')) }}
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div class="form-group required">
				<div class="input-group">
					{{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control inset-form-input', 'placeholder' => 'Confirm Password')) }}
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div style="display: none !important;">
				{{ Form::hidden('business', 'false') }}
			</div>

			<br>

			<div class="row">
				<div class="col-md-7">
					<div class="checkbox">
						{{ Form::checkbox('agree', $value = 'Yes', null, array('id' => 'agree', 'class' => 'form-control')) }}
						<label id="i_agree" for="agree">I accept the <a href="/resources/terms-and-conditions" target="_blank">terms &amp; conditions</a>.</label>
					</div>
				</div>
				<div class="col-md-5 text-right">
					{{ Form::submit('Register', array('class' => 'btn btn-success col-md-10 col-md-offset-2')) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>