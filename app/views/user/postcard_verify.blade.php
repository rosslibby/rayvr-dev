@extends('includes.user-nav')

@section('content')
<p class="h3 raleway lighter text-center">
	<i class="fa fa-ticket"></i> You need to verify your account before you can proceed.
	<br>
	<br>
</p>

<!-- Description for page -->
		<div class="col-md-12 text-center">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<p class="raleway more-height h5 light">
								<i class="fa fa-envelope"></i> We're sending you a postcard with a code to verify your account<br>
								Be on the lookout for a card that looks like this in your mailbox on <strong>{{ date('M d, Y', strtotime(json_decode(Auth::user()->postcard, true)['expected_delivery_date'])) }}:</strong><br><br>
							</p>
							<div class="row">
								<div class="col-md-6">
									{{ HTML::image('resources/img/user/postcard-back.jpg', 'RAYVR verification postcard (back)', ['width' => 250]) }}
								</div>
								<div class="col-md-6">
									{{ HTML::image('resources/img/user/postcard-front.jpg', 'RAYVR verification postcard (front)', ['width' => 250]) }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- The form -->

<br>
<br>
<br>
@stop

@section('out-container')
<div class="inset-form-container row-dark-blue">
	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				@include('forms.verify.inset-verify')
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop