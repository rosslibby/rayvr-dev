{{ Form::open(['url' => 'order/review']) }}
<div class="col-md-12">
	<p class="source-sans-pro text-left">{{ Form::label('review', 'Review text (copy + paste your Amazon&trade; review)', ['class' => 'control-label h3']) }}</p>
</div>
<div class="col-md-12 text-left">
	<p>{{ Form::textarea('review', null, ['id' => 'review', 'class' => 'form-control subtle-input']) }}</p>
	<p class="text-right">{{ Form::button('Submit review&nbsp;&nbsp;<i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
</div>
{{ Form::close() }}