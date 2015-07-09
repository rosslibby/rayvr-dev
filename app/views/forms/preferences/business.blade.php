@extends('includes.business-nav')

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
<!-- Modules -->
<script src="resources/js/businessApp.js"></script>

<!-- Controllers -->
<script src="resources/js/controllers/businessController.js"></script>

<!-- Directives -->
<script src="resources/js/directives/Business/autoSaveForm.js"></script>

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			{{-- Show "Create Your Account" for new registers --}}
			@if(Auth::user()->address == '' || Auth::user()->city == '' || Auth::user()->zip == '' || Auth::user()->country == '' || Auth::user()->first_name == '' || Auth::user()->last_name == '')
				<h2 class="fg-scheme-white"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Create Your Account</h2>
			@else
				<h2 class="fg-scheme-white"><span class="glyphicon glyphicon-wrench"></span>&nbsp;Settings</h2>
			@endif
		</div>
	</div>
@stop

@section('content')
<div class="content-wrapper" ng-app="BusinessApp">
	<div class="col-md-12">
		<br>
		<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<br>
				<div ng-controller="BusinessController">
				<form name="form.state" class="form-horizontal" auto-save-form="saveForm()">

					<div class="form-group" ng-class="{ 'has-error': form.state.text.$invalid }">
						{{ Form::label('first_name', 'First name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('first_name', $model['first_name'], ['class' => 'form-control required subtle-input', 'id' => 'firstName', 'ng-model' =>"form.data.first_name"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('last_name', 'Last name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('last_name', $model['last_name'], ['class' => 'form-control required subtle-input', 'id' => 'lastName', 'ng-model' =>"form.data.last_name"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('email', 'Email address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('email', $model['email'], ['class' => 'form-control required subtle-input', 'id' => 'email', 'ng-model' =>"form.data.email"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('business_name', 'Business name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('business_name', $model['business_name'], ['class' => 'form-control required subtle-input', 'id' => 'businessName', 'ng-model' =>"form.data.business_name"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address', 'Business address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('address', $model['address'], ['class' => 'form-control required subtle-input', 'id' => 'address', 'ng-model' =>"form.data.address"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address_2', 'Address line 2', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('address_2', $model['address_2'], ['class' => 'form-control subtle-input', 'ng-model' =>"form.data.address_2"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('city', 'City', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-4">
							{{ Form::text('city', $model['city'], ['class' => 'form-control subtle-input', 'id' => 'city', 'ng-model' =>"form.data.city"]) }}
						</div>
						{{ Form::label('state', 'State', ['class' => 'control-label col-md-1']) }}
						<div class="col-md-4">
							@include('forms.lists.statesjs')
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('country', 'Country', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-4">
							@include('forms.lists.countriesjs')
						</div>
						{{ Form::label('zip', 'Zip', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-3">
							{{ Form::text('zip', $model['zip'], ['class' => 'form-control subtle-input', 'id' => 'zip', 'ng-model' =>"form.data.zip", 'ng-pattern' => "/^\d+$/"]) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('phone', 'Phone number', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('phone', $model['phone'], ['class' => 'form-control required subtle-input', 'id' => 'phone', 'ng-model' =>"form.data.phone"]) }}
						</div>
					</div>

					<hr>
					<span ng-if="form.state.$dirty && form.state.$valid" class="help-block">Changes saving...</span>
					<span ng-if="!form.state.$dirty && form.state.$valid" class="help-block">Changes saved.</span>
					<span ng-if="form.state.$dirty && !form.state.$valid" class="help-block">Changes invalid.</span>

					{{ link_to('/', 'Continue', array('class' => 'btn btn-success')) }}
				</form>

				</div>
			{{-- 	{{ Form::open(['post' => 'preferences.storeBusiness', 'class' => 'form-horizontal', 'id' => 'businessPreferences']) }}

					<div class="form-group">
						{{ Form::label('first_name', 'First name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('first_name', $model['first_name'], ['class' => 'form-control required subtle-input', 'id' => 'firstName']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('last_name', 'Last name', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('last_name', $model['last_name'], ['class' => 'form-control required subtle-input', 'id' => 'lastName']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('email', 'Email address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('email', $model['email'], ['class' => 'form-control required subtle-input', 'id' => 'email']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('business_name', 'Business name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('business_name', $model['business_name'], ['class' => 'form-control required subtle-input', 'id' => 'businessName']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address', 'Business address', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-9">
							{{ Form::text('address', $model['address'], ['class' => 'form-control required subtle-input', 'id' => 'address']) }}
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
						{{ Form::label('city', 'City', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-4">
							{{ Form::text('city', $model['city'], ['class' => 'form-control subtle-input', 'id' => 'city']) }}
						</div>
						{{ Form::label('state', 'State', ['class' => 'control-label col-md-1']) }}
						<div class="col-md-4">
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
						{{ Form::label('phone', 'Phone number', ['class' => 'control-label required col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('phone', $model['phone'], ['class' => 'form-control required subtle-input', 'id' => 'phone']) }}
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="col-md-7 text-left source-sans-pro light">
							@if(Session::has('success'))
								<p><em>{{ Session::get('success') }}</em></p>
							@endif
						</div>
						<div class="col-md-4 text-right">
							{{ Form::submit('Save settings', ['class' => 'btn btn-success']) }}
						</div>
					</div>

				{{ Form::close() }} --}}
			</div>
		</div>
	</div>
</div>
@stop