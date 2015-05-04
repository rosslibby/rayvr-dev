@extends('includes.admin-nav')

@section('content')
<div class="header-wrapper">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{{ Form::open(['route' => 'discounts', 'class' => 'row']) }}
					<div class="col-md-3">
						{{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Code']) }}
					</div>
					<div class="col-md-3">
						{{ Form::text('discount', null, ['class' => 'form-control', 'placeholder' => 'Discount percentage']) }}
					</div>
					<div class="col-md-3 text-right">
						{{ Form::submit('+ New discount', ['class' => 'btn btn-info']) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
		<div class="row">
			<div class="list-group col-md-10 col-md-offset-1">
				@foreach($discounts as $discount)
					<div class="list-group-item">
						<span class="col-md-2"><strong>ID: </strong>{{ $discount->id }} <i class="fa fa-arrow-circle-o-right"></i></span>
						<strong>Code:</strong> <span class="label label-success">{{ $discount->code }}</span> | Discount: {{ $discount->discount }}%</span>
						{{-- {{ HTML::link('affiliates/'.$affiliate->id, '[Manage user]') }} --}}
						@if($discount->active == 1)
							<span class="badge badge-info">Active</span>
						@else
							<span class="badge badge-default">Inactive</span>
						@endif
					</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@stop