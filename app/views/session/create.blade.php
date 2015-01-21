@if (Session::has('login_errors'))
	<span class="error">Username or password incorrect.</span>
@endif

{{ Form::open(array('route' => 'session.store')) }}

	<p>{{ Form::label('email', 'Email') }}</p>
	{{ Form::email('email') }}

	<p>{{ Form::label('password', 'Password') }}</p>
	{{ Form::password('password') }}

	<p>{{ Form::submit('Submit') }}</p>

{{ Form::close() }}