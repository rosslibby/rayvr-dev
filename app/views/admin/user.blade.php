@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
		<div class="row">
			<div class="list-group col-md-10 col-md-offset-1">
				<p class="list-group-item"><strong>ID: </strong>{{ $user->id }}</p>
				<p class="list-group-item"><strong>Email: </strong>{{ $user->email }}</p>
				<p class="list-group-item"><strong>Name: </strong>{{ $user->last_name }}, {{ $user->first_name }}</p>
				<p class="list-group-item"><strong>Joined: </strong>{{ date('M. d, Y', strtotime($user->created_at)) }}</p>
				<p class="list-group-item"><strong>Invited by: </strong>{{ $user->invited_by }}</p>
				<p class="list-group-item"><strong>Referral code: </strong>{{ $user->invite_code }}</p>
				<p class="list-group-item"><strong>Address: </strong>{{ $user->address }}</p>
				@if($user->address_2)
					<p class="list-group-item"><strong>Address line 2: </strong>{{ $user->address_2 }}</p>
				@endif
				<p class="list-group-item"><strong>City: </strong>{{ $user->city }}</p>
				<p class="list-group-item"><strong>State: </strong>{{ $user->state }}</p>
				<p class="list-group-item"><strong>Zip: </strong>{{ $user->zip }}</p>
				<p class="list-group-item"><strong>Country: </strong>{{ $user->country }}</p>
				<p class="list-group-item"><strong>Phone #: </strong>{{ $user->phone }}</p>
				<p class="list-group-item"><strong>Current offer #: </strong>{{ $user->current }}</p>
				<p class="list-group-item"><strong>Account type: </strong>
					@if($user->active == 1 && $user->business)
						Business
						</p>
						<p class="list-group-item"><strong>Membership plan: </strong>{{ $user->stripe_plan }}</p>
						@if($user->trial_ends_at > date('Y-m-d H:i:s'))
							<p class="list-group-item"><strong>Trial ends: </strong>{{ $user->trial_ends_at }}</p>
						@elseif($user->subscription_ends_at > date('Y-m-d H:i:s'))
							<p class="list-group-item"><strong>Subscription expires: </strong>{{ $user->subscription_ends_at }}</p>
						@else
							<p class="list-group-item"><strong>Current plan: </strong>none</p>
						@endif
					@elseif($user->active == 3)
						Administrator
					@elseif($user->active == 1)
						User
					@else
						Inactive
					@endif
				</p>
				<p class="list-group-item"><strong>Gender: </strong>
					@if($user->gender)
						Female
					@else
						Male
					@endif
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				Actions:
				<br>
				@if(!$user->business)
					{{ HTML::link('users/'.$user->id.'/type', 'Change to Business account', ['class' => 'btn btn-warning']) }}
				@else
					{{ HTML::link('users/'.$user->id.'/type', 'Change to User account', ['class' => 'btn btn-warning']) }}
				@endif

				@if($user->active)
					{{ HTML::link('users/suspend/'.$user->id, 'Suspend account', ['class' => 'btn btn-danger']) }}
				@endif
			</div>
		</div>
	</div>
</div>
@stop