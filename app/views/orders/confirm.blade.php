{{ Form::open(['url' => 'order/confirm']) }}
<div class="col-md-12">
	<h2 class="source-sans-pro text-left">{{ Form::label('confirmation', 'Confirmation code', ['class' => 'control-label']) }}</h2>
</div>
<div class="col-md-9 text-left">
	<p>{{ Form::text('confirmation', null, ['id' => 'confirmation', 'class' => 'form-control subtle-input text-center larger taller-input']) }}</p>
</div>
<div class="col-md-3">
	<p class="text-left">{{ Form::button('Confirm order&nbsp;&nbsp;<i class="fa fa-check"></i>', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
</div>
{{ Form::close() }}