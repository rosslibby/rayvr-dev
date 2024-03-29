@extends('layouts.dashboard-master')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div>
			@if(Session::has('success'))
				<div class="row">
					<div class="alert alert-success alert-dismissable col-md-6 col-md-offset-3"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button> <strong>Success!</strong> {{ Session::get('success') }}</div>
				</div>
			@endif
			@if(Session::has('fail'))
				<div class="row">
					<div class="alert alert-danger alert-dismissable col-md-6 col-md-offset-3"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10005;</button> <strong>Error:</strong> {{ Session::get('fail') }}</div>
				</div>
			@endif
			<div class="col-md-10 col-md-offset-1">
			@if(Session::has('selected'))
				<h2 class="fg-scheme-white">What to Expect</h2>
				<br>
				<p class="h4 light fg-scheme-white text-left"><strong>We are currently checking your product against others already active in our system to make sure they’re not too similar. We grant exclusivity for specific product categories.</strong></p>
				<p class="light fg-scheme-white text-left">Next, we will order three products using the promo code you provided to make sure your product meets our quality standards.</p>
				<p class="light fg-scheme-white text-left">Within three days you should receive an email regarding the status of your first campaign. Use the link included to log into your account and get things rolling.</p>
				<p class="light fg-scheme-white text-left">Once you have logged in you can monitor progress for the campaign.</p>
			@else
				<h2 class="fg-scheme-white"><span class="fa fa-credit-card"></span>&nbsp;Payment Methods</h2>
				<br>
				<p class="h4 light fg-scheme-white text-left"><strong>We won't charge your credit card now.</strong></p>
				<p class="light fg-scheme-white text-left">This is just an authorization process. We will charge your credit card only upon a promotion's scheduled end date to reimburse our users for any incurred shipping expenses, and to charge for any accepted exposures.</p>
				<p class="light fg-scheme-white text-left">For more information on billing please review our {{ HTML::link('resources/terms-and-conditions', 'terms of service', ['target' => '_blank']) }} and {{ HTML::link('business/faq', 'FAQ', ['target' => '_blank']) }} pages.</p>
			@endif
			</div>
		</div>
	</div>
@stop

@section('content')
	<div class="col-md-12 inset-form-container row-dark-blue">

		{{ Form::open(['route' => 'billing', 'id' => 'payment-form']) }}

			<span class="payment-errors"></span>

			<div class="form-group required col-md-4">
				<div class="input-group">
						{{ Form::text(null, null, [
							'size' => 20,
							'data-stripe' => 'number',
							'class' => 'form-control inset-form-input',
							'placeholder' => 'Card number',
							'id' => 'card'
						]) }}<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
				</div>
			</div>

			<div class="form-group required col-md-2">
				<div class="input-group">
					{{ Form::text(null, null, [
						'size' => 4,
						'data-stripe' => 'cvc',
						'class' => 'form-control inset-form-input',
						'placeholder' => 'CVC'
					]) }}
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group required col-md-4 text-right">
					{{ Form::text(null, null, [
						'size' => 2,
						'data-stripe' => 'exp-month',
						'class' => 'form-control inset-form-input',
						'placeholder' => 'MM'
					]) }}
				</div>
				<div class="col-md-1">
					<p class="larger more-height">/</p>
				</div>
				<div class="form-group required col-md-6 text-left">
					{{ Form::text(null, null, [
						'size' => 4,
						'data-stripe' => 'exp-year',
						'class' => 'form-control inset-form-input',
						'placeholder' => 'YYYY'
					]) }}
				</div>
			</div>

			{{ Form::button('Add payment method', ['type' => 'submit', 'class' => 'btn btn-info']) }}
		{{ Form::close() }}
	</div>
	@if(!empty($data['customer']->sources->data))
	{{-- Details --}}
	<div class="col-md-10 col-md-offset-1">
		<br>
		<br>
		@foreach($data['customer']->sources->data as $card)
			<p class="source-sans-pro"><strong>{{ $card->brand }} <i class="fa fa-cc-{{ strtolower($card->brand) }}"></i></strong> ************{{ $card->last4 }} | Exp. {{ $card->exp_month }}/{{ $card->exp_year }} | {{ HTML::link('card/'.$card->id.'/delete', 'Remove card') }}</p>
			<hr>
		@endforeach
	</div>
		{{-- <div class="col-md-12">
		@foreach($data['customer']->sources->data as $card)
		*/ $class = "fa fa-cc-".strtolower($card->brand) /*
			<p>Card: <strong>************{{ $card->last4 }} / <i class="{{ $class }}"></i> {{ $card->funding }} / Exp. {{ $card->exp_month }}/{{ $card->exp_year }}</strong></p>
			<hr class="dashed">
		@endforeach
		<p>Card: <strong>************{{ $card->last4 }} / <i class="fa fa-cc-{{ $card->brand }}"></i> {{ $card->funding }} / Exp. {{ $card->exp_month }}/{{ $card->exp_year }}</strong></p> 
		@foreach($data['charges'] as $charge)
		<p>Charge: <strong>${{ $charge->charge }}</strong></p>
		<hr class="dashed">
		@endforeach
	</div> --}}
@endif
@stop