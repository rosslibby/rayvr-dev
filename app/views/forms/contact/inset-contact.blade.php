<!-- User registration -->
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['route' => 'contact.primary', 'id' => 'businessRegistration']) }}

			<div class="form-group required">
				<div class="input-group">
					{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email *']) }}
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
			
			<div class="form-group required">
				<div class="input-group">
					{{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control inset-form-input', 'placeholder' => 'Name *']) }}
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
			</div>

			<div class="form-group required">
				<div class="input-group">
					{{ Form::label('message', 'Message', ['class' => 'control-label fg-scheme-white light raleway']) }}
					{{ Form::textarea('message', null, ['id' => 'message', 'class' => 'form-control inset-form-input', 'cols' => '200']) }}
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-12 text-right">
					{{ Form::submit('Send message', ['class' => 'btn btn-success']) }}
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>