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
<div class="content-wrapper">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['route' => 'offers.store', 'files' => true]) }}

		<div class="row">
			<div class="col-md-4">
				<p class="h5"><strong>You can use a multi-use voucher code</strong></p>
				<div class="row">
					<div class="col-md-4">
						{{ Form::label('code', 'Discount Code', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						{{ Form::text('code', null, ['id' => 'code', 'class' => 'form-control']) }}
					</div>
				</div>
			</div>
			<div class="col-md-1 text-left">
				<h2><i class="fa fa-arrow-circle-o-right"></i></h2>
			</div>
			<div class="col-md-4">
				<p class="h5"><strong>OR a list of single-user voucher codes</strong></p>
				<div class="row">
					<div class="col-md-4">
						{{ Form::label('codes', 'Discount Codes', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						{{ Form::file('codes', null, ['id' => 'codes', 'class' => 'form-control']) }}
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<br>
			<br>

			<!-- Targeted gender -->

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
					{{ Form::label('gender', 'Targeted Gender', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="checkbox">
							{{ Form::checkbox('female', '1', null, ['id' => 'female']) }}
							{{ Form::label('female', 'Female') }}
						</div>
					</div>
					<div class="col-md-6">
						<div class="checkbox">
							{{ Form::checkbox('male', '0', null, ['id' => 'male']) }}
							{{ Form::label('male', 'Male') }}
						</div>
					</div>
				</div>
			</div>

			<!-- Prime customers vs. Regular customers -->

			<div class="col-md-4">
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
			</div>

		</div>

		<br>
		<br>
		<br>

		<div class="row">

			<!-- Number of offers -->

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
					{{ Form::label('quota', 'Number of Offers', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						{{ Form::select('quota', ['25' => '25', '50' => '50', '100' => '100', '200' => '200'], ['class' => 'selecter_basic', 'id' => 'quota']) }}
					</div>
				</div>
			</div>

			<!-- Date range -->

			<div class="col-md-8">
				<div class="row">
					<div class="col-md-4">
					{{ Form::label('date', 'Start &amp; End', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
				<br>
				<div class="row form-horizontal">
					<div class="col-md-10" id="sandbox-container">
						<div class="input-daterange input-group" id="datepicker">
							{{ Form::text('start', null, ['class' => 'form-control']) }}
							<span class="input-group-addon">to</span>
							{{ Form::text('end', null, ['class' => 'form-control']) }}
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<br>
				<br>
				<br>
				<div class="row">
					<div class="col-md-4">
						{{ Form::label('categories', 'Categories', ['class' => 'label bg-scheme-dark fg-scheme-white h6']) }}
					</div>
				</div>
			</div>
			<div class="row form-horizontal">
				<div class="col-md-11">
					<br>
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

		<br>
		<br>
		<br>

		<!-- Product data -->

		<div class="row">
			<div class="col-md-11">
				<div class="jumbotron">
					<br>
					<br>
					<div class="jumbotron-photo">
						{{ HTML::image($photo, $title, ['id' => 'product-photo']) }}
						{{ Form::text('photo', $photo, ['id' => 'photo_input', 'class' => 'hidden-input']) }}
					</div>
					<div class="jumbotron-contents">
						<h2 id="product-title">{{ $title }}</h2>
						{{ Form::text('title', $title, ['id' => 'title_input', 'class' => 'hidden-input']) }}
						<hr>
						{{ Form::label('description', 'Description') }}
						{{ Form::textarea('description', null, ['id' => 'description_input', 'class' => 'form-control']) }}
						<p><em>{{ HTML::link($url, $url, ['id' => 'product-url', 'target' => '_blank']) }}</em></p>
						{{ Form::text('link', $url, ['id' => 'link_input', 'class' => 'hidden-input']) }}
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-11 text-right">
				{{ Form::submit('Submit Offer', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop