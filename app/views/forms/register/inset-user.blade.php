<!-- User registration -->

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['route' => 'register.store', 'id' => 'businessRegistration']) }}

			<div class="form-group required">
				<div class="input-group">
					{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email']) }}
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
			
			<div class="form-group required">
				<div class="input-group">
					{{ Form::password('password', ['id' => 'true_password', 'class' => 'form-control inset-form-input', 'placeholder' => 'Password']) }}
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div class="form-group required">
				<div class="input-group">
					{{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control inset-form-input', 'placeholder' => 'Confirm Password']) }}
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div style="display: none !important;">
				{{ Form::hidden('business', 'false') }}
				@if(isset($referral))
				{{ Form::hidden('invited_by', $referral) }}
				@endif
			</div>

			<br>

			<div class="row">
				<div class="col-md-7">
					<div class="checkbox">
						{{ Form::checkbox('agree', $value = 'Yes', null, ['id' => 'agree', 'class' => 'form-control']) }}
						<label id="i_agree" for="agree">I accept the <a href="/resources/terms-and-conditions" target="_blank">terms &amp; conditions</a>.</label>
					</div>
				</div>
				<div class="col-md-5 text-right">
					{{ Form::submit('Register', ['class' => 'btn btn-success col-md-10 col-md-offset-2']) }}
				</div>
			</div>

			<br>
			<hr class="dashed">
			
			<div class="row">
				<div class="col-md-12 text-center">
					<p>{{ HTML::link('login', 'Or sign in with your existing account &rarr;', ['class' => 'raleway light']) }}</p>
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>