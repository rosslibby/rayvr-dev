{{ Form::open(['post' => 'document/shipping', 'files' => true]) }}
<p>{{ Form::label('document', 'Upload proof of shipping cost') }}</p>
<p>{{ Form::file('document') }}</p>
<p>{{ Form::submit('Upload document') }}</p>
{{ Form::close() }}