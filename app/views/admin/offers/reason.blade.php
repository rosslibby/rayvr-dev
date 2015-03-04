{{ Form::open(['route' => 'offers.deny']) }}
{{ Form::label('reason', 'Reason for denial') }}
<br>
{{ Form::textarea('reason') }}
<br>
{{ Form::hidden('id', $id) }}
{{ Form::submit('Confirm denial') }}
{{ Form::close() }}