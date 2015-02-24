@foreach($matches as $match)
{{ Form::open(['post' => 'offers/select']) }}
{{ Form::hidden('match', $match->id) }}
{{ Form::button('ACCEPT OFFER', ['type' => 'submit', 'name' => 'accept', 'value' => 1]) }}
{{ Form::button('DECLINE OFFER', ['type' => 'submit', 'name' => 'accept', 'value' => 3]) }}
{{ Form::close() }}
<hr>
@endforeach