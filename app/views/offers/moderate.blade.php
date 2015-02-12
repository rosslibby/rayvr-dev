@foreach($offers as $offer)
	<h3>{{ $offer['offer']->id }} | {{ $offer['offer']->title }}</h3>
	<img src="{{ $offer['offer']->photo }}" width="200" />
	<p><em>{{ $offer['offer']->description }}</em></p>
	<p>Number to send out: {{ $offer['offer']->quota }}</p>
	<p>Start {{ $offer['offer']->start }}</p>
	<p>End {{ $offer['offer']->end }}</p>
	<p>Categories:</p>
	<ul>
		@foreach($offer['categories'] as $category)
			<li>{{ $category['title'] }}</li>
		@endforeach
	</ul>
	{{ Form::open(['route' => 'offers.approve']) }}
		{{ Form::hidden('id', $offer['offer']->id) }}
		{{ Form::submit('Approve') }}
	{{ Form::close() }}
	{{ Form::open(['route' => 'offers.deny']) }}
		{{ Form::hidden('id', $offer['offer']->id) }}
		{{ Form::submit('Deny') }}
	{{ Form::close() }}
	<hr>
@endforeach