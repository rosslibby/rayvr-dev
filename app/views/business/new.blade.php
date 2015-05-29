@extends('layouts.business-dash')

@section('content')
{{-- */ $offers = Offer::where('business_id', $user->id)->get() /* --}}

<section class="content">
	<div class="row">

		@foreach($offers as $offer)
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="info-box bg-aqua">
					{{-- {{ HTML::image($offer->photo, $offer->title, ['class' => 'info-box-icon']) }} --}}
					<span class="info-box-icon">
						<i class="fa fa-tag"></i>
					</span>
					<div class="info-box-content">
						<!-- Product title -->
						<span class="info-box-text">{{ $offer->title }}</span>

						<!-- Number of products accepted -->
						<span class="info-box-number">{{ count($offer->orders) }}/{{ $offer->quota }} accepted</span>

						<!-- Progress indicator -->
						<div class="progress">
							<div class="progress-bar progress-bar-green" style="width: {{ (count($offer->orders) / $offer->quota) * 100 }}%"></div>
						</div>

						<!-- View promotion individually -->
						<span class="progress-description">
							{{ HTML::link('promotions/track/'.$offer->id, $offer->title.' &rarr;', ['class' => 'btn btn-xs btn-info pull-right']) }}
						</span>
					</div>
				</div>
			</div>
		@endforeach

	</div>
</section>
@stop