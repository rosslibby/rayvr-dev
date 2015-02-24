{{ Form::open(['post' => 'shipping/approve']) }}
@foreach($claims as $claim)
<li>
	{{ $claim->offer_id }}
	|
	{{ $claim->user->email }}
	|
	{{ $claim->cost }}
	<!-- actual data -->
	{{ Form::hidden('order', $claim) }}
	{{ Form::hidden('user', $claim->user) }}
	{{ Form::hidden('cost', $claim->cost) }}
	{{ Form::button('Approve', ['type' => 'submit']) }}
</li>
@endforeach
{{ Form::close() }}