@extends('layouts.landing-master')

@section('heading')
Contact the RAYVR team.
@stop

@section('description')
We are here to answer any questions you have about our user or business services.
@stop

@section('content')
<div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
	@if(Session::has('success'))
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<div class="alert alert-success alert-dissmissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Thank you!</strong>
				{{ Session::get('success') }}
			</div>
			</div>
		</div>
	@endif
	@if(Session::has('error'))
	<div class="row">
		<div class="10 col-md-offset-1">
			<div class="alert alert-danger alert-dissmissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<strong>Oops!</strong>
				{{ Session::get('error') }}
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel" role="tabpanel">
				<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
					<li role="presentation" data-toggle="tab" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Contact RAYVR</a></li>
				</ul>
				<br>
				<div class="tab-content">
					@include('forms.contact.primary')
				</div>
			</div>
		</div>
	</div>
</div>
@stop