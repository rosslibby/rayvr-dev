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
		<div class="col-md-8 col-md-offset-2">
			<div class="panel" role="tabpanel">
				<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a></li>
					<li role="presentation" data-toggle="tab" class="active"><a href="#business" aria-controls="business" role="tab" data-toggle="tab">Business</a></li>
				</ul>
				<br>
				<div class="tab-content">
				@include('includes.login')
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
@stop