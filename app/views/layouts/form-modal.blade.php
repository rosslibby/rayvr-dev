@extends('layouts.landing-master')

@section('content')
	<br>
	<br>
	<br>
	<div class="col-md-4 col-md-offset-4">
		<br>
		<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel" role="tabpanel">
					<ul id="loginTabs" class="nav nav-tabs nav-justified" role="tablist">
						<li role="presentation"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">User</a></li>
						<li role="presentation" data-toggle="tab" class="active"><a href="#business" aria-controls="business" role="tab" data-toggle="tab">Business</a></li>
					</ul>
					<br>
					<div class="tab-content">
					@section('modal-content')
					@show
					</div>
					<br>
				</div>
			</div>
		</div>
	</div>
@stop