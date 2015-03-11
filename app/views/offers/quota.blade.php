@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('content')
{{ Form::open(['route' => 'offers.store', 'files' => true]) }}
<div class="content-wrapper">
	<div class="col-md-10 col-md-offset-1">
		<h3 class="raleway">Step 6: <span class="light">Maximum Product Sendouts</span></h3>
		<hr class="dashed">

		<div class="row">
			{{-- If there are enough potential user-matches to justify a campaign, show the slider --}}
			@if($maximum >= 25)
				<div class="col-md-12 text-center">
					<p class="h3 source-sans-pro"><span class="light"><strong><span class="totalCount"><span id="numOffers">25</span></strong> Offers</span></p>
					<p class="text-center"><strong>___________________________</strong></p>
					<p class="h3 source-sans-pro"><span class="light"><strong>$<span id="totalCost">{{ (5 * 25) }}</span></strong></span></p>
					<br>
				</div>
				<div class="col-md-12">
					{{ Form::text('quota', 25, ['id' => 'quotaSlider', 'data-slider-max' => $maximum, 'data-slider-ticks-snap-bounds' => '5', 'data-slider-min' => '25', 'data-slider-step' => '1', 'style' => 'width: 100%;', 'data-placement' => 'bottom', 'data-slider-ticks' => '[25, '.(int)($maximum/2).', '.$maximum.']']) }}
				</div>
				<div class="row">
					<br>
					<div class="col-md-1 text-left">
						<p>&nbsp;&nbsp;25</p>
					</div>
					<div class="col-md-11 text-right">
						<p>50&nbsp;&nbsp;</p>
					</div>
				</div>
			@else
				<div class="col-md-12 text-center">
					<p class="h3 source-sans-pro"><span class="light"><strong><span class="totalCount"><span id="numOffers">15</span></strong> Offers</span></p>
					<p class="text-center"><strong>___________________________</strong></p>
					<p class="h3 source-sans-pro"><span class="light"><strong>$<span id="totalCost">{{ (5 * 15) }}</span></strong></span></p>
					<br>
				</div>
				<div class="col-md-12">
					{{ Form::text('quota', 15, ['id' => 'quotaSlider', 'data-slider-max' => 25, 'data-slider-ticks-snap-bounds' => '5', 'data-slider-min' => '15', 'data-slider-step' => '1', 'style' => 'width: 100%;', 'data-placement' => 'bottom', 'data-slider-ticks' => '[15, 20, 25]']) }}
				</div>
				<div class="row">
					<br>
					<div class="col-md-1 text-left">
						<p>&nbsp;&nbsp;15</p>
					</div>
					<div class="col-md-11 text-right">
						<p>25&nbsp;&nbsp;</p>
					</div>
				</div>
			@endif
		</div>
		<br>
		
		<h3 class="raleway">Step 7: <span class="light">Voucher Code</span></h3>
		<hr class="dashed">

		<div class="row">
			<br>
			<div class="col-md-5">
				<p class="h4">{{ Form::label('code', 'Multi-use Discount Code', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-tag"></i></p>
				<p>{{ Form::text('code', null, ['id' => 'code', 'class' => 'form-control subtle-input']) }}</p>
			</div>
			<div class="col-md-2 text-center">
				<h2 class="raleway light">or</h2>
			</div>
			<div class="col-md-5">
				<p class="h4">{{ Form::label('codes', 'Single-use Discount Codes', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-tags"></i></p>
				<p><span class="btn btn-info btn-file">Upload a file<span id="codeFileName"></span>{{ Form::file('codes', null, ['id' => 'codes', 'class' => 'form-control']) }}</span></p>
			</div>
		</div>

		<br>
		<hr class="dashed">
		<br>

		<div class="row">
			<div class="col-md-12 text-center">
				{{ Form::submit('Submit Offer', ['class' => 'btn btn-info h2 raleway normal']) }}
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}
@stop