{{ Form::open(['route' => 'shipping.claim']) }}
<h3>Shipping cost</h3>
<p>
{{ Form::label('dollars', '$') }}
{{ Form::text('dollars', null, ['size' => 2, 'maxlength' => 2]) }}
{{ Form::label('cents', '.') }}
{{ Form::text('cents', null, ['size' => 2, 'maxlength' => 2]) }}
{{ Form::hidden('order', $order) }}
</p>
<p>{{ Form::submit('Place claim') }}</p>
{{ Form::close() }}