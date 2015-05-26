@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		@if(Session::has('success'))
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>{{ Session::get('success') }}</strong>
			</div>
		@endif
		@if(count($claims))
		{{ Form::open(['post' => 'shipping/approve']) }}
		<ul class="list-group">
			@foreach($claims as $claim)
				<li class="list-group-item">
					<span class="col-md-10">
					{{ $claim->offer_id }}
					|
					{{ $claim->user->email }}
					|
					<strong>$ {{ money_format('%.2n', $claim->cost) }}</strong>
					</span>
					<!-- actual data -->
					{{ Form::hidden('order', $claim) }}
					{{ Form::hidden('user', $claim->user) }}
					{{ Form::hidden('cost', $claim->cost) }}
					{{ Form::button('Approve', ['type' => 'submit', 'class' => 'btn btn-success']) }}
				</li>
			@endforeach
		</ul>
		{{ Form::close() }}
		@endif
	</div>
</div>
@stop