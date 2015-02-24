<p><strong>Order</strong></p>
<pre>{{ $claim }}</pre>
{{ Form::open(['post' => 'offers.shipping']) }}
{{ Form::hidden('claim', $claim->id) }}
<p>{{ Form::submit('Dispute claim') }}</p>
{{ Form::close() }}