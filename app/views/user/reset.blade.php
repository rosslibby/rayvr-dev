{{ Form::open(['route' => 'reset']) }}
{{ Form::label('password') }}
{{ Form::hidden('email', $vars['email']) }}
{{ Form::hidden('code', $vars['code']) }}
{{ Form::hidden('confirm', $vars['confirm']) }}
{{ Form::password('password') }}
{{ Form::submit('Save') }}
{{ Form::close() }}