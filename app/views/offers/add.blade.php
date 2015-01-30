@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<h2 class="fg-scheme-dark"><span class="glyphicon glyphicon-link"></span>&nbsp;Enter the product link</h2>

			{{ Form::open(array('', 'id' => 'fetch')) }}

				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-9 col-md-offset-1">
							{{ Form::text('url', null, array('class' => 'form-control bg-scheme-transparent-gray', 'id' => 'url')) }}
						</div>
						{{ Form::submit('FETCH DATA', array('class' => 'btn btn-primary')) }}
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
	<div class="col-md-6 col-md-offset-3">
		{{ Form::open(array('route' => 'offers.store')) }}

		<div class="row">

			<!-- Targeted gender -->

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
					{{ Form::label('gender', 'Targeted Gender', array('class' => 'label bg-scheme-dark fg-scheme-white h6')) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="checkbox">
							{{ Form::checkbox('female', '1', null, array('id' => 'female')) }}
							{{ Form::label('female', 'Female') }}
						</div>
					</div>
					<div class="col-md-6">
						<div class="checkbox">
							{{ Form::checkbox('male', '0', null, array('id' => 'male')) }}
							{{ Form::label('male', 'Male') }}
						</div>
					</div>
				</div>
			</div>

			<!-- Prime customers vs. Regular customers -->

			<div class="col-md-4">
				<div class="row">
					<div class="col-md-6">
					{{ Form::label('gender', 'Prime Exclusive', array('class' => 'label bg-scheme-dark fg-scheme-white h6')) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4">
						<div class="radio" data-toggle="tooltip" data-placement="bottom" title data-original-title="This option is reserved for premium members">
							{{ Form::radio('prime', '1', false, array('disabled')) }}
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
					{{ Form::label('quota', 'Number of Offers', array('class' => 'label bg-scheme-dark fg-scheme-white h6')) }}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						{{ Form::select('quota', array('25' => '25', '50' => '50', '100' => '100', '200' => '200'), array('class' => 'selecter_basic', 'id' => 'quota')) }}
					</div>
				</div>
			</div>

			<!-- Date range -->

			<div class="col-md-8">
				<div class="row">
					<div class="col-md-4">
					{{ Form::label('quota', 'Start &amp; End', array('class' => 'label bg-scheme-dark fg-scheme-white h6')) }}
					</div>
				</div>
				<br>
				<div class="row form-horizontal">
					<div class="col-md-10" id="sandbox-container">
						<div class="input-daterange input-group" id="datepicker">
							{{ Form::text('start', null, array('class' => 'form-control')) }}
							<span class="input-group-addon">to</span>
							{{ Form::text('end', null, array('class' => 'form-control')) }}
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
						{{ Form::label('categories', 'Categories', array('class' => 'label bg-scheme-dark fg-scheme-white h6')) }}
					</div>
				</div>
			</div>
			<div class="row form-horizontal">
				<div class="col-md-11">
					<br>
					@foreach ($interests as $interest)
						<div class="col-md-4">
							<div class="checkbox">
								{{ Form::checkbox('interest[]', $value = $interest['id'], null, array('id' =>  'interest_'.$interest['id'], 'class' => 'form-control')) }}
								{{ Form::label('interest_'.$interest['id'], $interest['title'], array('id' => 'interest_'.$interest['id'])) }}
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
					<div class="jumbotron-photo">
						{{ HTML::image($photo, $title, array('id' => 'product-photo')) }}
						{{ Form::text('photo', $photo, array('id' => 'photo_input', 'class' => 'hidden-input')) }}
					</div>
					<div class="jumbotron-contents">
						<h2 id="product-title">{{ $title }}</h2>
						{{ Form::text('title', $title, array('id' => 'title_input', 'class' => 'hidden-input')) }}
						<p><iframe src="data:text/html;charset=utf-8,{{ $description }}" id="product-description"></iframe></p>
						{{ Form::textarea('description', null, array('id' => 'description_input', 'class' => 'hidden-input')) }}
						<p><em>{{ HTML::link($url, $url, array('id' => 'product-url', 'target' => '_blank')) }}</em></p>
						{{ Form::text('link', $url, array('id' => 'link_input', 'class' => 'hidden-input')) }}
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-11 text-right">
				{{ Form::submit('Submit Offer', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@stop