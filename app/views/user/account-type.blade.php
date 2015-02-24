{{ Form::open(['post' => 'users.type']) }}
<p>{{ Form::label('type', 'User '.$id) }}</p>
{{ Form::hidden('id', $id) }}
<p>{{ Form::label('user', 'User') }}{{ Form::radio('type', 'User', null, ['id' => 'user']) }}</p>
<p>{{ Form::label('business', 'Business') }}{{ Form::radio('type', 'Business', null, ['id' => 'business']) }}</p>
<p>{{ Form::submit('Save') }}</p>
{{ Form::close() }}