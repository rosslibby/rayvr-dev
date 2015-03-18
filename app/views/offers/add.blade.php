@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h3 class="raleway fg-scheme-white">Step 1: <span class="light">Enter the product link</span></h3>
			<p class="light fg-scheme-white">This will pull your product title, photo, and ASIN from the Amazon&trade; listing.</p>

			{{ Form::open(['', 'id' => 'fetch']) }}

				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							{{ Form::text('url', null, ['class' => 'form-control bg-scheme-transparent-gray', 'id' => 'url', 'autofocus']) }}
						</div>
						{{ Form::submit('FETCH DATA', ['class' => 'btn btn-primary']) }}
					</div>

					<br>

					<!-- Progress bar -->
					<div class="row">
						<div id="progress-container" class="col-md-9 col-md-offset-1 progressbar" data-toggle="tooltip" data-placement="right" title data-original-title="Data fetched (0%)">
							<div class="progress">
								<div id="progress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
									<span class="sr-only">0% Complete</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
@stop

@section('content')
<br>
<br>
{{ Form::open(['route' => 'offers.quota', 'files' => true]) }}
<div class="content-wrapper">
	<div class="col-md-10 col-md-offset-1">
		<h3 class="raleway"><span class="light">Product Information</span></h3>
		<hr>

		<div class="row">
			<br>
			<!-- Product image -->
			<div class="col-md-2 col-md-offset-1 well">
				{{ HTML::image($photo, $title, ['id' => 'product-photo']) }}
				{{ Form::text('photo', $photo, ['id' => 'photo_input', 'class' => 'hidden-input']) }}
			</div>

			<!-- Product title -->
			<div class="col-md-9 text-left">
				<p class="h4 raleway light" id="product-title">{{ $title }}</p>
				{{ Form::text('title', $title, ['id' => 'title_input', 'class' => 'hidden-input']) }}
			</div>

			<!-- Product link -->
			{{ Form::hidden('link', $link = null, ['id' => 'link_input', 'class' => 'hidden-input']) }}

			<!-- Product ASIN -->
			{{ Form::hidden('asin', $asin = null, ['id' => 'asin_input', 'class' => 'hidden-input']) }}
		</div>

		<br>
		<br>
{{-- 		<!-- Review page link -->
		<h3 class="raleway">Step 2: <span class="light">Link to Review Page</span></h3>
		<hr>

		<div class="row">
			<br>
			<div class="col-md-12">
				<p class="h4">{{ Form::label('review_link', 'Review Link', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-link"></i></p>
				<p>{{ Form::text('review_link', null, ['class' => 'form-control subtle-input taller-input']) }}</p>
			</div>
		</div>

		<br>
		<br> --}}
		<!-- Quota & Dates -->
		<h3 class="raleway">Step 2: <span class="light">Start &amp; End Dates</span></h3>
		<hr>

		{{-- <div class="row">
			<br>
			<!-- Number of offers -->
			<div class="col-md-6">
				<p class="h4">{{ Form::label('quota', 'Number of Offers', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-cubes"></i></p>
				{{ Form::select('quota', ['25' => '25', '50' => '50', '100' => '100', '200' => '200'], ['class' => 'selecter_basic', 'id' => 'quota']) }}
			</div>
		</div>
		<br>
		<hr> --}}
		<div class="row">
			<!-- Date range -->
			<div class="col-md-6">
				<p class="h4">{{ Form::label('date', 'Preferred start &amp; end dates', ['class' => 'control-label raleway h4 light']) }}</p>
				<div class="sandbox-container">
					<div class="input-daterange input-group col-md-12" id="datepicker">
						{{--*/
							$date = date('m/d/Y');
							$futureDate = null;
							if(date('d') == 1)
							{
								$startDate = date('m/d/Y', strtotime($date. ' + 4 days'));
								$endDate = date('m/d/Y', strtotime($date. ' + 9 days'));
							}
							else
							{
								$startDate = date('m/d/Y', strtotime($date. ' + 6 days'));
								$endDate = date('m/d/Y', strtotime($date. ' + 11 days'));
							}
						/*--}}
						{{ Form::text('start', $startDate, ['class' => 'form-control subtle-input']) }}
						<span class="input-group-addon">to</span>
						{{ Form::text('end', $endDate, ['class' => 'form-control subtle-input']) }}
					</div>
				</div>
				<br>
				<p class="light text-center">(Plan for <strong>at least 3 days</strong> from today for our review process.)</p>
			</div>
		</div>

		<br>
		<br>
		<!-- Shipping Information -->
		<h3 class="raleway">Step 3: <span class="light">Shipping Information</span></h3>
		<hr>

		<div class="row">
			<br>



			{{----------------------------
			 -- AS OF 03/07/2015 WE ARE --
			 -- NO LONGER CHECKING      --
			 -- WHETHER BUSINESS        --
			 -- PREFERS PRIME USERS OR  --
			 -- WHETHER THE BUSINESS    --
			 -- OWNS ANY NUMBER OF      --
			 -- "OFFER PACKS", AS BOTH  --
			 -- OF THESE OPTIONS ARE    --
			 -- BEING REMOVED ENTIRELY  --
			 -----------------------------}}
{{-- 			<div class="col-md-4">
				<p class="h4">{{ Form::label('prime', 'Prime Exclusive') }}</p>
				<div class="col-md-3">
					<div class="radio" data-toggle="tooltip" data-placement="bottom" title data-original-title="This option requires the Prime offer pack">
						{{ Form::radio('prime', '1', false) }}
						{{ Form::label('prime', 'Yes') }}
					</div>
				</div>
				<div class="col-md-3">
					<div class="radio">
						{{ Form::radio('prime', '0', true) }}
						{{ Form::label('prime', 'No') }}
					</div>
				</div>
			</div> --}}
				<div class="col-md-12">
					<p class="h5">{{ Form::label('free_shipping', 'Is this product always shipped free?', ['class' => 'control-label raleway h5 light']) }}</p>
					<div class="col-md-4">
						<div class="col-md-4">
							<div class="radio" id="shipFree">
								{{ Form::radio('free_shipping', '1', true) }}
								{{ Form::label('free_shipping', 'Yes') }}
							</div>
						</div>
						<div class="col-md-4">
							<div class="radio" id="shipPaid">
								{{ Form::radio('free_shipping', '0', false) }}
								{{ Form::label('free_shipping', 'No') }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="shippingCost">
				<hr>
				<div class="row">
					<div class="col-md-6">
						<p class="h5">{{ Form::label('shipping_cost', 'If no, please estimate the cost of shipping:', ['class' => 'control-label raleway h5 light']) }}</p>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-usd"></i></span>{{ Form::text('shipping_cost', null, ['class' => 'form-control subtle-input']) }}
						</div>
					</div>
				</div>
			</div>

		<br>
		<br>
		<!-- Demographic information -->
		<h3 class="raleway">Step 4: <span class="light">Target Audience</span></h3>
		<hr>

		<div class="row">
			<br>
			<div class="col-md-6 col-md-offset-3 text-center">
				<!-- Targeted gender -->

				<div class="row">
					<p class="h4"><i class="fa fa-mars"></i>&nbsp;{{ Form::label('gender', 'Targeted Gender', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-venus"></i></p>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
						<div class="checkbox">
							{{ Form::checkbox('female', '1', true, ['id' => 'female']) }}
							{{ Form::label('female', 'Female') }}
						</div>
					</div>
					<div class="col-md-3">
						<div class="checkbox">
							{{ Form::checkbox('male', '1', true, ['id' => 'male']) }}
							{{ Form::label('male', 'Male') }}
						</div>
					</div>
				</div>
				<br>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="h4 text-center">{{ Form::label('categories', 'Relevant Categories', ['class' => 'control-label raleway h4 light']) }}</p>

				<div class="col-md-12 form-horizontal">
					@foreach ($interests as $interest)
						<div class="col-md-4">
							<div class="checkbox">
								{{ Form::checkbox('interest[]', $value = $interest['id'], null, ['id' =>  'interest_'.$interest['id'], 'class' => 'form-control']) }}
								{{ Form::label('interest_'.$interest['id'], $interest['title'], ['id' => 'interest_'.$interest['id']]) }}
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>

			

			<!-- Prime customers vs. Regular customers -->

		{{--	<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
						{{ Form::label('prime', 'Prime&reg; Exclusive', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4">
						<div class="radio" data-toggle="tooltip" data-placement="bottom" title data-original-title="This option requires the Prime offer pack">
							{{ Form::radio('prime', '1', false) }}
							{{ Form::label('prime', 'Yes') }}
						</div>
					</div>
					<div class="col-md-4">
						<div class="radio">
							{{ Form::radio('prime', '0', true) }}
							{{ Form::label('prime', 'No') }}
						</div>
					</div>
				</div>
			</div> --}}

		<br>
		<hr>
		<br>

		<div class="row">
			<div class="col-md-11 text-right">
				{{ Form::submit('Continue to next step &rarr;', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop