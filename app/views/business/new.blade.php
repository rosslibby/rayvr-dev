@extends('layouts.business-dash')

@section('content')

{{-- Product data fetch & retrieve --}}

<!-- Product data -->
<section class="content bg-scheme-dark">

	<div class="row">

		<section class="col-lg-10 col-lg-offset-1 col-sm-12 col-xs-12">

			<h1 class="fg-scheme-white raleway largest"><strong>Step 1</strong></h1>
			<h3 class="fg-scheme-yellow raleway">Enter the Amazon&trade; link to your product</strong></h3>
			<p class="fg-scheme-white">This will pull your <strong>product title</strong>, <strong>photo</strong>, and <strong>ASIN</strong> from the Amazon<sup>&trade;</sup> listing.</p>

			{{ Form::open(['', 'id' => 'fetch']) }}

				<div class="row">
					<div class="col-lg-10 col-xs-12">
						{{ Form::text('url', null, ['class' => 'form-control bg-scheme-transparent-gray', 'id' => 'url', 'autofocus', 'placeholder' => 'Amazon&trade; product link']) }}
					</div>
					<div class="col-lg-2 col-xs-6">
						{{ Form::submit('FETCH DATA', ['class' => 'btn btn-success']) }}
					</div>
				</div>

				<br>

				<!-- Progress bar -->
				<div class="row">
					<div id="progress-container" class="col-xs-10 progressbar" data-toggle="tooltip" data-placement="right" title data-original-title="Data fetched (0%)">
						<div class="progress">
							<div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">0% Complete</span>
							</div>
						</div>
						<div id="successfulFetch" class="fg-scheme-white">
							Your product data has been successfuly fetched.
						</div>
					</div>
				</div>

			{{ Form::close() }}

			<br>
			<br>

		</section>

	</div>

</section>

{{-- Promotion details --}}
{{ Form::open(['route' => 'offers.quota', 'files' => true, 'id' => 'productPage1']) }}

	<!-- Start & End Dates -->
	<section class="content">

		<div class="row">

			<section class="col-lg-10 col-lg-offset-1 col-sm-12 col-xs-12">

				<h1 class="raleway largest"><strong>Step 2</strong></h1>
				<h3 class="raleway">Promotion start &amp; end dates</h3>
				<p>These are the desired dates that you want to run your promotion. We will make sure to send out the promotion between these dates. Please note that the start date is <strong>3 business days</strong> from today because we need time to review your product for quality control. We may choose to order your product prior to your desired launch date to ensure that we offer only quality products to our users.</p>
				<p><em>(Plan for <strong>at least 3 days</strong> from today for our review process. Ensure coupon codes are active at the time you submit the promotion).</em></p>

				<br>
			<!-- Date range -->
				<div class="row">
					<div class="col-lg-6 col-sm-12 col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">{{ Form::label('date', 'Preferred start &amp; end dates', ['class' => 'control-label raleway h4 light']) }}</h3>
							</div>
							<div class="sandbox-container box-body">
								<div class="input-daterange input-group col-md-12" id="datepicker">
									{{--*/
										$date = date('m/d/Y');
										$futureDate = null;
										if(date('d') == 1)
										{
											$startDate = date('m/d/Y', strtotime($date. ' + 3 days'));
											$endDate = date('m/d/Y', strtotime($date. ' + 8 days'));
										}
										else
										{
											$startDate = date('m/d/Y', strtotime($date. ' + 5 days'));
											$endDate = date('m/d/Y', strtotime($date. ' + 10 days'));
										}
									/*--}}
									{{ Form::text('start', $startDate, ['class' => 'form-control subtle-input']) }}
									<span class="input-group-addon">to</span>
									{{ Form::text('end', $endDate, ['class' => 'form-control subtle-input']) }}
								</div>

								<br>

								<p class="light text-center">(Plan for <strong>at least 3 days</strong> from today for our review process.)</p>
							</div>
						</div>
					</div>
				</div>

			</section>

		</div>

	</section>

{{ Form::close() }}
@stop