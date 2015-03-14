{{ Form::open(['url' => 'order/review']) }}
<div class="col-md-12">
	<p class="source-sans-pro text-center">{{ Form::label('review', 'Confirm that you have reviewed this offer', ['class' => 'control-label h3']) }}</p>
</div>
<div class="col-md-12 text-center">
	{{--<p>{{ Form::textarea('review', null, ['id' => 'review', 'class' => 'form-control subtle-input']) }}</p>--}}
	<p class="text-center">{{ Form::button('Confirm review <i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
</div>
{{ Form::close() }}