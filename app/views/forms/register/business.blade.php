<!-- Business tab -->
<div role="tabpanel" class="tab-pane active" id="business">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{{ Form::open(array('route' => 'register.store')) }}

				<div class="form-group required">
					{{ Form::label('email', 'Email Address', array('class' => 'control-label subtle-label')) }}
					<div class="input-group">
						{{ Form::email('email', null, array('class' => 'form-control subtle-input')) }}
						<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					</div>
				</div>
				
				<div class="form-group required">
					{{ Form::label('password', 'Password', array('class' => 'control-label subtle-label')) }}
					<div class="input-group">
						{{ Form::password('password', array('class' => 'form-control subtle-input')) }}
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					</div>
				</div>

				<div class="form-group required">
					{{ Form::label('password_confirmation', 'Confirm password', array('class' => 'control-label subtle-label')) }}
					<div class="input-group">
						{{ Form::password('password_confirmation', array('class' => 'form-control subtle-input')) }}
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					</div>
				</div>

				<div style="display: none !important;">
					{{ Form::hidden('business', 'true') }}
				</div>

				<div class="form-group required">
					{{ Form::label('referral', 'Invite code', array('class' => 'control-label subtle-label')) }}
					{{ Form::text('referral', $referral['referral'], array('class' => 'form-control subtle-input')) }}
				</div>

				<div class="row">
					<div class="col-md-12 text-right">
						{{ Form::submit('Sign In', array('class' => 'btn btn-primary')) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
</div>