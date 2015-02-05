<!-- Primary contact tab -->
<div role="tabpanel" class="tab-pane active" id="primary">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			{{ Form::open(array('route' => 'contact.primary')) }}

				<div class="form-group">
					{{ Form::label('email', 'Your email', array('class' => 'subtle-label')) }}
					{{ Form::email('email', null, array('class' => 'form-control subtle-input')) }}
				</div>

				<div class="form-group">
					{{ Form::label('name', 'Your name', array('class' => 'subtle-label')) }}
					{{ Form::text('name', null, array('class' => 'form-control subtle-input')) }}
				</div>

				<div class="form-group">
					{{ Form::label('message', 'Your message', array('class' => 'subtle-label')) }}
					{{ Form::textarea('message', null, array('class' => 'form-control subtle-input')) }}
				</div>

				<hr>

				<div class="form-group text-right">
					<button type="submit" class="btn btn-success">Send <span class="glyphicon glyphicon-send"></span></button>
				</div>

			{{ Form::close() }}
		</div>
	</div>
	<hr>
</div>