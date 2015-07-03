@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">
	<br>
	<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{{ Form::open(['route' => 'affiliates', 'class' => 'row']) }}
					<div class="col-md-3">
						{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email*']) }}
					</div>
					<div class="col-md-2">
						{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name']) }}
					</div>
					<div class="col-md-2">
						{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name']) }}
					</div>
					<div class="col-md-2">
						{{ Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Website']) }}
					</div>
					<div class="col-md-3 text-right">
						{{ Form::submit('+ New affiliate', ['class' => 'btn btn-info']) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<div class="row">
			<div class="list-group col-md-10 col-md-offset-1">
				@foreach($affiliates as $affiliate)
					<div class="list-group-item">
						<span class="col-md-2"><strong>ID: </strong>{{ $affiliate->id }} <i class="fa fa-arrow-circle-o-right"></i></span>
						{{ $affiliate->email }} | Referral code: <span class="label label-success">https://rayvr.com/register/{{ $affiliate->invite_code }}</span>
						{{ HTML::link('affiliates/'.$affiliate->invite_code, ' [View recruits]') }}
						@if($affiliate->active == 1)
							<span class="badge badge-info">Active</span>
						@else
							<span class="badge badge-default">Inactive</span>
						@endif
					</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@stop