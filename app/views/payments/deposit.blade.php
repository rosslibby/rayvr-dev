@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		@if(Session::has('success'))
		<div class="row">
			<div class="alert alert-warning alert-dismissable col-md-8 col-md-offset-2">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button>
				<strong>IMPORTANT: </strong>
				{{ Session::get('success') }}
			</div>
		</div>
		@endif
		<div class="text-center">
			<h3 class="fg-scheme-white raleway">Membership &amp; Payments</h3>
		</div>
		<br>
		<br>
		<div class="col-md-10 col-md-offset-1 text-center">
			<div class="row">
				@if(Session::has('confirm'))
					<div class="alert alert-success alert-dismissable col-md-8 col-md-offset-2">
						{{ Form::button('×', ['class' => 'close', 'data-dismiss' => 'alert', 'aria-hidden' => true]) }}
						<strong>Thank you! </strong>{{ Session::get('confirm') }}
					</div>
				@endif
			</div>
			<br>
			{{ Form::open(['url' => 'https://www.paypal.com/cgi-bin/webscr', 'method' => 'post', 'target' => '_top']) }}
				{{ Form::hidden('cmd', '_s-xclick') }}
				{{ Form::hidden('hosted_button_id', 'TA739M6WQQQ5C') }}
				{{ Form::submit('Pay shipping deposit', ['class' => 'btn btn-success']) }}
				{{ HTML::image('https://www.paypalobjects.com/en_US/i/scr/pixel.gif', null, ['width' => '1', 'height' => '1', 'border' => '0']) }}
			{{ Form::close() }}
			<br>
		</div>
	</div>
@stop

@section('content')
@stop