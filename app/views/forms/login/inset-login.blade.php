<!-- User and Business Login -->
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(array('route' => 'session.store', 'id' => 'userLogin')) }}

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

			<div class="row">
				<div class="col-md-7">
					<div class="checkbox">
						{{ Form::checkbox('remember', null, null, array('id' => 'remember', 'class' => 'form-control')) }}
						<label id="remember_me" for="remember">Remember me</label>
					</div>
				</div>
				<div class="col-md-5 text-right">
					{{ Form::submit('Sign in', array('class' => 'btn btn-success col-md-10 col-md-offset-2')) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>