{{ Form::open(['route' => 'offers.approve']) }}
{{ Form::label('exclusivity', 'Exclusivity category') }}
{{ Form::text('exclusivity', null, ['id' => 'exclusivity']) }}
{{ Form::hidden('id', $id) }}
{{ Form::submit('Confirm approval') }}
{{ Form::close() }}