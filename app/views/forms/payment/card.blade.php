@extends('layouts.dashboard-master')


@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
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
			<h2 class="fg-scheme-white"><span class="fa fa-credit-card"></span>&nbsp;Billing</h2>
				<br>
				<p class="light fg-scheme-white text-left">We won’t charge your credit card now. This is just an authorization process. We will charge your credit card only upon completion of a promotion to reimburse our users for any incurred shipping expenses.</p>
				<p class="light fg-scheme-white text-left">For more information on billing please review our {{ HTML::link('resources/terms-and-conditions', 'terms of service', ['target' => '_blank']) }} and {{ HTML::link('business/faq', 'FAQ', ['target' => '_blank']) }} pages.</p>
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