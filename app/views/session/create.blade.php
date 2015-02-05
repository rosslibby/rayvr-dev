@extends('layouts.landing-master')

@section('heading')
Sign in to your account.
@stop

@section('description')
Manage your offers, preferences, and score in your RAYVR dashboard.
@stop

@section('content')
<div class="col-md-4 col-md-offset-4">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel" role="tabpanel">
				<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation" data-toggle="tab" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User &amp; Business Login</a></li>
				</ul>
				<br>
				<div class="tab-content">
					@include('includes.login')
				</div>
				<br>
			</div>
			@if(Session::has('error'))
				<br>
				<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{ Session::get('error') }}
					<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
				</div>
			@endif
		</div>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@stop