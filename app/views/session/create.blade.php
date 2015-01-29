@extends('layouts.landing-master')

@if (Session::has('login_errors'))
	<span class="error">Username or password incorrect.</span>
@endif

@section('content')
<br>
<br>
<br>
<div class="col-md-4 col-md-offset-4">
	<div class="row">
		<h3 class="fg-scheme-white lighter text-center">Sign in to your dashboard</h3>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="panel" role="tabpanel">
			<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
				<li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a></li>
				<li role="presentation" data-toggle="tab" class="active"><a href="#business" aria-controls="business" role="tab" data-toggle="tab">Business</a></li>
				<li role="presentation" data-toggle="tab"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
			</ul>
			<br>
			<div class="tab-content">

				<!-- User tab -->
				<div role="tabpanel" class="tab-pane" id="user">
				</div>

				<!-- Business tab -->
				<div role="tabpanel" class="tab-pane active" id="business">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							{{ Form::open(array('route' => 'session.store')) }}

								<div class="form-group">
									{{ Form::label('email', 'Email Address', array('class' => 'subtle-label')) }}
									{{ Form::email('email', null, array('class' => 'form-control subtle-input')) }}
								</div>

								<div class="form-group">
									{{ Form::label('password', 'Password', array('class' => 'subtle-label')) }}
									{{ Form::password('password', array('class' => 'form-control subtle-input')) }}
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="checkbox">
											{{ Form::checkbox('remember', $value = 1, null, array('id' =>  'remember', 'class' => 'form-control')) }}
											{{ Form::label('remember', 'Remember Me', array('id' => 'remember', 'class' => 'subtle-label')) }}
										</div>
									</div>
									<div class="col-md-6 text-right">
										{{ Form::submit('Sign In', array('class' => 'btn bg-scheme-dark-gray border-scheme-dark-gray')) }}
									</div>
								</div>

							{{ Form::close() }}
						</div>
					</div>
				</div>

				<!-- Register tab -->
				<div role="tabpanel" class="tab-pane" id="register">
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
@stop