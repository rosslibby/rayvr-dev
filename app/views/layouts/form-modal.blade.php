@extends('layouts.landing-master')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<br>
		<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel" role="tabpanel">
					<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
						<li role="presentation" data-toggle="tab" class="active"><a href="#business" aria-controls="business" role="tab" data-toggle="tab">Business</a></li>
					</ul>
					<br>
					<div class="tab-content">
					@section('modal-content')
					@show
					</div>
					<br>
				</div>
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong> or <strong>{{ HTML::link('login', 'Sign in') }}</strong>
					</div>
				@endif
			</div>
		</div>
	</div>
@stop