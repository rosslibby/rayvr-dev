@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<div class="list-group col-md-10 col-md-offset-1">
			<br>
			@foreach($comments as $comment)
				<div class="list-group-item">
					<span class="col-md-2"><strong>User ID: </strong>{{ $comment->user_id }} </span>
					<span class="col-md-2"><strong> Promo ID: </strong>{{ $comment->offer_id }} </span>
					<span class="col-md-2"><strong> Rating: </strong>{{ $comment->rate }} / 5 </span>

					@if($comment->damage == 1)
						<span class="badge badge-danger">Damaged</span>
					@endif
					@if($comment->malfunction == 1)
						<span class="badge badge-warning">Malfunctioned</span>
					@endif
					@if($comment->description == 1)
						<span class="badge badge-info">Not as Described</span>
					@endif
					<br>			
					<span><strong>Experience: </strong>{{ $comment->experience }} </span>
					<br>
					<br>
				</div>
			@endforeach
			{{ $comments->links(); }}
		</div>

	</div>
</div>
@stop