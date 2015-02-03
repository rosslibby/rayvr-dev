@extends('includes.business-nav')

@section('sidebar')
	@include('includes.business-sidebar')
@stop

@section('contentarea')
	<div class="header-wrapper">
		<div class="text-center">
			<div class="content-wrapper">
				<br>
				<br>
				<div class="col-md-11">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<div class="row well">
								{{ Form::open(['post' => 'payments.subscription', 'id' => 'payment-form','class' => 'form-horizontal col-md-11']) }}

									<span class="payment-errors"></span>

									<div class="form-group">
										<div class="col-md-4">
											{{ Form::label('card', 'Card Number', ['class' => 'control-label']) }}
										</div>
										<div class="col-md-8">
											{{ Form::text('card', null, ['size' => '20', 'data-stripe' => 'number', 'class' => 'form-control subtle-input']) }}
										</div>
									</div>

									<hr>

									<div class="form-group">
										<div class="col-md-4">
										{{ Form::label('cvc', 'CVC') }}
										</div>
										<div class="col-md-4">
										{{ Form::text('cvc', null, ['size' => '4', 'data-stripe' => 'cvc', 'class' => 'form-control subtle-input']) }}
										</div>
									</div>

									<hr>

									<div class="form-group">
										<div class="col-md-4">
											{{ Form::label('expiration', 'Expiration (MM/YYYY)') }}
										</div>
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-3">
												{{ Form::text('expiration', null, ['size' => '2', 'data-stripe' => 'exp-month', 'class' => 'form-control subtle-input']) }}
												</div>
												<div class="col-md-1">
													<span class="h3 lighter"> / </span>
												</div>
												<div class="col-md-5">
												{{ Form::text('expiration', null, ['size' => '4', 'data-stripe' => 'exp-year', 'class' => 'form-control col-md-1 subtle-input']) }}
												</div>
											</div>
										</div>
									</div>

									<hr>

									<div class="form-group">
										{{ Form::submit('Submit Payment', ['class' => 'btn btn-success']) }}
									</div>

								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('content')
@stop