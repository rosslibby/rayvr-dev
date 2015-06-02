@extends('layouts.business-dash')

@section('content')

<section class="content-header">
	<h1>Promotion ID #{{ $promotion->id }} <small>{{ $promotion->title }}</small></h1>
	<br>
	{{ HTML::link('promotions/track', '&larr; Return to Track Promotion', ['class' => 'btn btn-info']) }}

	<ol class="breadcrumb">
		<li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>{{ HTML::link('promotions/track', 'Track') }}</li>
		<li>{{ HTML::link('promotions/track/'.$promotion->id, 'Promo. '.$promotion->id) }}</li>
	</ol>
</section>

<section class="content">
	<div class="row">

		<section class="col-lg-3">
			<div class="box box-info">
				<div class="box-header">
				</div>
				<div class="box-body text-center">
					{{ HTML::image($promotion->photo, $promotion->title, ['class' => 'col-xs-12']) }}
				</div>
			</div>
		</section>

		<section class="col-lg-6 col-sm-12 col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Confirmed orders</h3>
				</div>
				<div class="box-body no-padding">
					<table class="table table-striped">
						<tbody>
							<tr>
								<th>ID</th>
								<th>Order Conf.</th>
								<th>Shipping</th>
							</tr>
							@foreach($promotion->orders as $order)
								<tr>
									<td>{{ $order->id }}</td>
									<td>{{ $order->confirmation_number }}</td>
									@if($order->cost > 0)
										<td>${{ money_format('%.2n', $order->cost) }}</td>
									@else
										<td>Free</td>
									@endif
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</section>

	</div>
</section>
@stop