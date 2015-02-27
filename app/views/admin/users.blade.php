@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<div class="list-group col-md-10 col-md-offset-1">
			@foreach($users as $user)
				<div class="list-group-item">
					<span class="col-md-2"><strong>ID: </strong>{{ $user->id }} <i class="fa fa-arrow-circle-o-right"></i></span>
					{{ $user->email }}
					{{ HTML::link('users/'.$user->id, '[Manage user]') }}
					@if(($user->active == 1 && $user->business) || $user->active == 2)
						<span class="badge badge-success">Business</span>
						@if($user->stripe_plan)
							@if($user->trial_ends_at > date('Y-m-d H:i:s'))
								<span class="badge badge-warning">Trial ends {{ date('M d, Y', strtotime($user->trial_ends_at)) }}</span>
							@elseif($user->subscription_ends_at > date('Y-m-d H:i:s'))
								<span class="badge badge-warning">Membership expires {{ date('M d, Y', strtotime($user->subscription_ends_at)) }}</span>
							@else
								<span class="badge badge-danger">Not subscribed</span>
							@endif
						@else
							<span class="badge badge-danger">Not subscribed</span>
						@endif
					@elseif($user->active == 3)
						<span class="badge badge-danger">Administrator</span>
					@elseif($user->active == 1)
						<span class="badge badge-info">User</span>
					@else
						<span class="badge badge-default">{{ $user->active }}</span>
					@endif
				</div>
			@endforeach
		</div>

	</div>
</div>
@stop