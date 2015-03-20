{{ Form::open(['post' => 'image/save', 'files' => true]) }}
<p>{{ Form::label('image', 'Upload a product photo') }}</p>
<p>{{ Form::file('image') }}</p>
<p>{{ Form::submit('Upload photo') }}</p>
{{ Form::close() }}