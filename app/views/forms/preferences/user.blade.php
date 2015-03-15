@extends('includes.user-nav')

@section('content')
<div class="content-wrapper">
	<div class="col-md-12">
		<br>
		<br>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 well">
				@if(Session::has('success'))
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
					<strong>{{ Session::get('success') }}</strong>
				</div>
				@endif
				<br>
				{{ Form::open(['post' => 'preferences.storeUser', 'class' => 'form-horizontal', 'id' => 'preferences']) }}

					<div class="form-group">
						{{ Form::label('first_name', 'First name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('first_name', $model['first_name'], ['class' => 'form-control required subtle-input', 'id' => 'firstName']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('last_name', 'Last name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('last_name', $model['last_name'], ['class' => 'form-control required subtle-input', 'id' => 'lastName']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('email', 'Email address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('email', $model['email'], ['class' => 'form-control required subtle-input', 'id' => 'email']) }}
						</div>
					</div>

					<hr>

					<div class="form-group">
						{{ Form::label('profile', 'Amazon&trade; Profile', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							<p>In order to use RAYVR you must link your Amazon profile to your RAYVR profile. This does not give us access to your Amazon account, it only allows us to verify that you are a legitimate Amazon shopper.</p>
							<p>Click {{ HTML::link('http://www.amazon.com/gp/pdp/profile/', 'this link', ['target' => '_blank']) }} and, if prompted, login to Amazon. Once you arrive on your profile page, copy the url and paste it in the input below.</p>
							{{ Form::text('profile', $model['profile'], ['class' => 'form-control required subtle-input', 'id' => 'profile']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address', 'Address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('address', $model['address'], ['class' => 'form-control required subtle-input', 'id' => 'address']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address_2', 'Address line 2', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('address_2', $model['address_2'], ['class' => 'form-control subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('city', 'City', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-3">
							{{ Form::text('city', $model['city'], ['class' => 'form-control subtle-input', 'id' => 'city']) }}
						</div>
						{{ Form::label('state', 'State', ['class' => 'control-label col-md-1']) }}
						<div class="col-md-2">
							@include('forms.lists.states')
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('country', 'Country', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-4">
							@include('forms.lists.countries')
						</div>
						{{ Form::label('zip', 'Zip', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-3">
							{{ Form::text('zip', $model['zip'], ['class' => 'form-control subtle-input', 'id' => 'zip']) }}
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="row">
							{{ Form::label(null, 'Gender', ['class' => 'control-label required col-md-2']) }}
						</div>
						<div class="row">
							<div class="col-md-2 col-md-offset-2">

								{{--*/
									/**
									 * This reflects whether a user is
									 * male or female
									 */
									$gender = $model['gender'];
									$male = null;
									$female = null;
									if(!$gender)
										$male = 1;
									elseif($gender)
										$female = 1;
								/*--}}
								<p class="normal col-md-12 text-right">Male&nbsp;&nbsp;{{ Form::radio('gender', '0', $male, ['id' => 'male']) }}</p>
								<p class="normal col-md-12 text-right">Female&nbsp;&nbsp;{{ Form::radio('gender', '1', $female, ['id' => 'female']) }}</p>
							</div>
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="row">
							{{ Form::label('interests', 'Interests', ['class' => 'control-label required col-md-2']) }}
						</div>

						<div class="col-md-12">
							@foreach ($categories as $interest)
								<div class="col-md-4">
									<div class="checkbox">
										{{ Form::checkbox('interest[]', $value = $interest['id'], $interest['interest'], array('id' =>  'interest_'.$interest['id'], 'class' => 'form-control')) }}
										{{ Form::label('interest_'.$interest['id'], $interest['title'], array('id' => 'interest_'.$interest['id'])) }}
									</div>
								</div>
							@endforeach
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-7 text-left source-sans-pro light">
							@if(Session::has('success'))
								<p><em>{{ Session::get('success') }}</em></p>
							@endif
						</div>
						<div class="col-md-2 text-right">
							{{ Form::submit('Save settings', ['class' => 'btn btn-success']) }}
						</div>
					</div>
				{{ Form::close() }}
				<hr>
				<div class="col-md-3">
					{{ Form::open(['route' => 'deactivate', 'id' => 'deactivate']) }}
						{{ Form::button('DEACTIVATE ACCOUNT', ['class' => 'btn btn-danger', 'id' => 'deactivateAccount']) }}
					{{ Form::close() }}
				</div>
				<div class="col-md-4">
					<p>This action cannot be undone</p>
				</div>
			</div>
		</div>
	</div>
</div>
@stop