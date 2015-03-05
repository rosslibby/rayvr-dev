{{ Form::open(['route' => 'account/reset']) }}
<p>{{ Form::label('email', 'Please enter your email: ') }}</p>
<p>{{ Form::text('email') }}</p>
<p>{{ Form::submit('Request password reset') }}</p>
{{ Form::close() }}