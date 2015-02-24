{{ Form::open(['url' => 'order/review']) }}
<div class="col-md-12">
	<h2 class="source-sans-pro text-left">{{ Form::label('review', 'Review URL (the link to your review)', ['class' => 'control-label']) }}</h2>
</div>
<div class="col-md-9 text-left">
	<p>{{ Form::text('review', null, ['id' => 'review', 'class' => 'form-control subtle-input text-center larger taller-input']) }}</p>
</div>
<div class="col-md-3">
	<p class="text-left">{{ Form::button('Submit review&nbsp;&nbsp;<i class="fa fa-pencil"></i>', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
</div>
{{ Form::close() }}