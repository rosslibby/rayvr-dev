@extends('includes.user-nav')

@section('content')
<div class="content-wrapper">
	<div class="col-md-12">
		<br>
		<br>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 well">
				<br>
				{{ Form::open(['post' => 'preferences.storeUser', 'class' => 'form-horizontal']) }}

					<div class="form-group">
						{{ Form::label('first_name', 'First name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('first_name', $model['first_name'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('last_name', 'Last name', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('last_name', $model['last_name'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('email', 'Email address', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('email', $model['email'], ['class' => 'form-control required subtle-input']) }}
						</div>
					</div>

					<hr>
				
					<div class="form-group">
						{{ Form::label('address', 'Business address', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-7">
							{{ Form::text('address', $model['address'], ['class' => 'form-control required subtle-input']) }}
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
						{{ Form::label('city', 'City', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-3">
							{{ Form::text('city', $model['city'], ['class' => 'form-control subtle-input']) }}
						</div>
						{{ Form::label('state', 'State', ['class' => 'control-label col-md-1']) }}
						<div class="col-md-2">
							@include('forms.lists.states')
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('zip', 'Zip', ['class' => 'control-label col-md-2']) }}
						<div class="col-md-2">
							{{ Form::text('zip', $model['zip'], ['class' => 'form-control subtle-input']) }}
						</div>
					</div>

					<hr>

					<div class="form-group">
						<div class="row">
							{{ Form::label('interests', 'Interests', ['class' => 'control-label col-md-2']) }}
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
						<div class="col-md-9 text-right">
							{{ Form::submit('Save settings', ['class' => 'btn btn-success']) }}
						</div>
					</div>

				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@stop