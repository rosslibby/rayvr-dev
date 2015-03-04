@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h2 class="fg-scheme-white"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Preferences</h2>
		</div>
	</div>
@stop

@section('content')
<div class="content-wrapper">
	<div class="col-md-12">
		<br>
		<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				@if(Session::has('success'))
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
					<strong>Your settings have been saved</strong>
				</div>
				@endif
				<br>
				{{ Form::open(['post' => 'preferences.storeBusiness', 'class' => 'form-horizontal']) }}

					<div class="form-group">
						{{ Form::label('first_name', 'First name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('first_name', $model['first_name'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('last_name', 'Last name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('last_name', $model['last_name'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('email', 'Email address', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('email', $model['email'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('business_name', 'Business name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('business_name', $model['business_name'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address', 'Business address', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('address', $model['address'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address_2', 'Address line 2', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('address_2', $model['address_2'], ['class' => 'form-control subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('city', 'City', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-4">
							{{ Form::text('city', $model['city'], ['class' => 'form-control subtle-input']) }}
						</div>
						{{ Form::label('state', 'State', ['class' => 'control-label col-md-1']) }}
						<div class="col-md-4">
							@include('forms.lists.states')
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('country', 'Country', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-4">
							@include('forms.lists.countries')
						</div>
						{{ Form::label('zip', 'Zip', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-3">
							{{ Form::text('zip', $model['zip'], ['class' => 'form-control subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('phone', 'Phone number', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('phone', $model['phone'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>

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
			</div>
		</div>
	</div>
</div>
@stop