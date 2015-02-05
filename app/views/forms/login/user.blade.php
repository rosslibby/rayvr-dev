<!-- User tab -->
<div role="tabpanel" class="tab-pane active" id="user">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{{ Form::open(array('route' => 'session.store')) }}

				<div class="form-group">
					{{ Form::label('email', 'Email Address', array('class' => 'subtle-label')) }}
					{{ Form::email('email', null, array('class' => 'form-control subtle-input')) }}
				</div>

				<div class="form-group">
					{{ Form::label('password', 'Password', array('class' => 'subtle-label')) }}
					{{ Form::password('password', array('class' => 'form-control subtle-input')) }}
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="checkbox">
							{{ Form::checkbox('remember', $value = 1, null, array('id' =>  'remember', 'class' => 'form-control')) }}
							{{ Form::label('remember', 'Remember Me', array('id' => 'remember', 'class' => 'subtle-label')) }}
						</div>
					</div>
					<div class="col-md-6 text-right">
						{{ Form::submit('Sign In', array('class' => 'btn btn-success')) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
	<hr>
</div>