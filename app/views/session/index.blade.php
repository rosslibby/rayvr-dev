@extends('layouts.landing-master')

@section('video')
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='http://player.vimeo.com/video/118839151' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
@stop

@section('content')
<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
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