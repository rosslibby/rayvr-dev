@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h2 class="fg-scheme-white"><i class="glyphicon glyphicon-link"></i>&nbsp;Enter the product link</h2>

			{{ Form::open(['', 'id' => 'fetch']) }}

				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							{{ Form::text('url', null, ['class' => 'form-control bg-scheme-transparent-gray', 'id' => 'url']) }}
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
{{ Form::open(['route' => 'offers.store', 'files' => true]) }}
<div class="content-wrapper">
	<div class="col-md-10 col-md-offset-1">
		<h3 class="raleway">Step 1: <span class="light">Product Information</span></h3>
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
		</div>
		<h3 class="raleway">Step 2: <span class="light">Voucher Code</span></h3>
		<hr>

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
		<br>
		<!-- Review page link -->
		<h3 class="raleway">Step 3: <span class="light">Link to Review Page</span></h3>
		<hr>

		<div class="row">
			<br>
			<div class="col-md-12">
				<p class="h4">{{ Form::label('review_link', 'Review Link', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-link"></i></p>
				<p>{{ Form::text('review_link', null, ['class' => 'form-control subtle-input taller-input']) }}</p>
			</div>
		</div>

		<br>
		<br>
		<!-- Quota & Dates -->
		<h3 class="raleway">Step 4: <span class="light">Offer Details</span></h3>
		<hr>

		<div class="row">
			<br>
			<!-- Number of offers -->
			<div class="col-md-6">
				<p class="h4">{{ Form::label('quota', 'Number of Offers', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-cubes"></i></p>
				{{ Form::select('quota', ['25' => '25', '50' => '50', '100' => '100', '200' => '200'], ['class' => 'selecter_basic', 'id' => 'quota']) }}
			</div>
			<!-- Date range -->
			<div class="col-md-6">
				<p class="h4">{{ Form::label('date', 'Preferred Start Date', ['class' => 'control-label raleway h4 light']) }}&nbsp;<i class="fa fa-calendar"></i></p>
				<div class="sandbox-container">
					<div class="input-daterange input-group col-md-8" id="datepicker">
						{{--*/
							$date = date('m/d/Y');
							$futureDate = null;
							if(date('d') == 1)
								$futureDate = date('m/d/Y', strtotime($date. ' + 4 days'));
							else
								$futureDate = date('m/d/Y', strtotime($date. ' + 6 days'));
						/*--}}
						<span class="input-group-addon">Start</span>
						{{ Form::text('start', $futureDate, ['class' => 'form-control subtle-input']) }}
					</div>
					<br>
					<div class="input-group col-md-8">
						<span class="input-group-addon">for</span>
						{{ Form::text('timeframe', 5, ['class' => 'form-control subtle-input']) }}
						<span class="input-group-addon">days</span>
					</div>
				</div>
			</div>
		</div>

		<br>
		<br>
		<!-- Shipping Information -->
		<h3 class="raleway">Step 5: <span class="light">Shipping Information</span></h3>
		<hr>

		<div class="row">
			<br>
			<div class="col-md-4">
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
			</div>
			<div class="col-md-3 text-left">
				<h2 class="raleway light">if no</h2>
			</div>
			<div class="col-md-5">
				<p class="h5">{{ Form::label('free_shipping', 'Is this product eligible for free shipping?', ['class' => 'control-label raleway h5 light']) }}</p>
				<div class="col-md-3">
					<div class="radio">
						{{ Form::radio('free_shipping', '1', false) }}
						{{ Form::label('free_shipping', 'Yes') }}
					</div>
				</div>
				<div class="col-md-3">
					<div class="radio">
						{{ Form::radio('free_shipping', '0', true) }}
						{{ Form::label('free_shipping', 'No') }}
					</div>
				</div>
				<p class="h5">{{ Form::label('shipping_cost', 'If no, estimate the cost of shipping:', ['class' => 'control-label raleway h5 light']) }}</p>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-usd"></i></span>{{ Form::text('shipping_cost', null, ['class' => 'form-control subtle-input']) }}
				</div>
			</div>
		</div>

		<br>
		<br>
		<!-- Demographic information -->
		<h3 class="raleway">Step 6: <span class="light">Target Audience</span></h3>
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
							{{ Form::checkbox('female', '1', null, ['id' => 'female']) }}
							{{ Form::label('female', 'Female') }}
						</div>
					</div>
					<div class="col-md-3">
						<div class="checkbox">
							{{ Form::checkbox('male', '0', null, ['id' => 'male']) }}
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
				{{ Form::submit('Submit Offer', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop