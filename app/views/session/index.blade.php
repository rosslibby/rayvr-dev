@extends('layouts.landing-master')

@section('video')
<iframe src="//player.vimeo.com/video/118839151" width="1000" height="562" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
@stop

@section('content')
<div class="col-md-4 col-md-offset-4">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel" role="tabpanel">
				<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation" data-toggle="tab" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Business Registration</a></li>
				</ul>
				<br>
				<div class="tab-content">
					@include('forms.register.business')
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
@stop