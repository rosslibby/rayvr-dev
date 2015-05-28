@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('content')
{{ Form::open(['route' => 'offers.store', 'files' => true, 'id' => 'productPage2']) }}
<div class="content-wrapper">
	<div class="col-md-10 col-md-offset-1">
		<h3 class="raleway">Step 6: <span class="light">Maximum Product Sendouts</span></h3>
		<hr>

		<div class="row">
			{{-- If the business has used their trial promotion already, show the quota slider --}}
			{{-- Show the slider for businesses' trial promotions as well (05/03/2015) --}}
			{{-- @if(count(Auth::user()->offers)) --}}
				<div class="col-md-12 text-center">
					<p class="h3 source-sans-pro"><span class="light"><strong><span class="totalCount"><span id="numOffers">{{ ((int)($maximum*.75)) }}</span></strong> Products</span></p>
					<p class="text-center"><strong>___________________________</strong></p>
					<p class="h3 source-sans-pro"><span class="light"><strong>$<span id="totalCost">{{ (5 * ((int)($maximum*.75))) }}</span></strong></span></p>
					<br>
				</div>
				<div class="col-md-12">
					{{ Form::text('quota', $maximum, ['id' => 'quotaSlider', 'data-slider-max' => $maximum, 'data-slider-min' => '1', 'data-slider-step' => '1', 'style' => 'width: 100%;', 'data-placement' => 'bottom', 'data-slider-value' => ((int)($maximum*.75)), 'data-slider-ticks' => '[1, '.$maximum.']']) }}
				</div>
				<div class="row">
					<br>
					<div class="col-md-1 text-left">
						<p>&nbsp;&nbsp;1</p>
					</div>
					<div class="col-md-11 text-right">
						<p>{{ $maximum }}&nbsp;&nbsp;</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<p>Move the slider left or right to select the number of products you have available for this promotion. The dollar amount shown is the maximum you may be charged for redemptions in this promotion. This total does not include the cost of any shipping reimbursements.</p>
					</div>
				</div>
			{{-- @else --}}
				{{-- <div class="col-md-12 text-center">
					<p class="h3 source-sans-pro"><span class="light"><strong><span class="totalCount"><span id="numOffers">15</span></strong> Products</span></p>
					<p class="text-center"><strong>___________________________</strong></p>
					<p class="h3 source-sans-pro"><span class="light"><strong>Free Trial / <span class="fg-scheme-dark">$75 Value</span></strong></span></p>
					<p>After your free trial of 15 free redemptions, this is where you will choose your desired number of redemptions.</p>
					<br>
				</div> --}}
			{{-- @endif --}}
		</div>
		<br>
		
		<h3 class="raleway">Step 7: <span class="light">Promotional Code</span></h3>
		<p class="light">Provide the promotional code for 100% discount. We recommend single-redemption promotional codes, but 1 code (multi-use) is accepted as well. Please read our terms of service for further information about promotional codes.</p>
		<hr>
		<p class="h4 light">The start and end dates you previously selected are: <strong>Start: {{ Session::get('offer')['start'] }} &rarr; End: {{ Session::get('offer')['end'] }}</strong><br><br><span class="fg-scheme-light"><i class="fa fa-exclamation-triangle"></i></span> Please make sure that your promotional codes are active <strong>starting today</strong> for our review process.</p>
		<hr>

		<div class="row">
			<br>
			<div class="col-md-5">
				<p class="h4">{{ Form::label('code', 'Multi-use Promotional Code', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-tag"></i></p>
				<p>{{ Form::text('code', null, ['id' => 'code', 'class' => 'form-control subtle-input']) }}</p>
			</div>
			<div class="col-md-2 text-center">
				<h2 class="raleway light">or</h2>
			</div>
			<div class="col-md-5">
				<p class="h4">{{ Form::label('codes', 'Single-use Promotional Codes - At no extra cost!', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-tags"></i></p>
				<p><span class="btn btn-info btn-file">Upload a file<span id="codeFileName"></span>{{ Form::file('codes', null, ['id' => 'codes', 'class' => 'form-control']) }}</span></p>
				<p class="light">Please use only .txt files for code lists.</p>
			</div>
		</div>

		<br>
		<hr>
		<br>
		<div class="row">
			<div class="col-md-12 text-center">
				{{--@if(count(Auth::user()->offers))--}}
					{{ Form::submit('Proceed to Billing', ['class' => 'btn btn-info h2 raleway normal']) }}
				{{--@else
					{{ Form::submit('Submit Offer', ['class' => 'btn btn-info h2 raleway normal']) }}
				@endif--}}
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop