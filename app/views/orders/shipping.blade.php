{{ Form::open(['url' => 'order/shipping']) }}
<div class="col-md-12">
	<h2 class="source-sans-pro text-left">{{ Form::label('shipping', 'Cost of shipping', ['class' => 'control-label']) }}</h2>
</div>
<div class="col-md-1 text-right">
	<p class="h3"><sup><i class="fa fa-usd"></i></sup></p>
</div>
<div class="col-md-2 text-left">
	<p>{{ Form::text('dollars', null, ['id' => 'dollars', 'class' => 'form-control subtle-input text-center larger taller-input']) }}</p>
</div>
<div class="col-md-2 text-left">
	<p>{{ Form::text('cents', null, ['id' => 'cents', 'class' => 'form-control subtle-input text-center larger taller-input']) }}</p>
</div>
<div class="col-md-3">
	<p class="text-left">{{ Form::button('Request reimbursement&nbsp;&nbsp;(<i class="fa fa-usd"></i>)', ['type' => 'submit', 'class' => 'btn btn-success larger heavy raleway']) }}</p>
	<p class="h3 raleway"><strong>or</strong></p>
	<br>
	<p class="text-left">{{ Form::button('I didn\'t pay for shipping&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right"></i>', ['type' => 'submit', 'class' => 'btn btn-info larger heavy raleway']) }}</p>
</div>
{{ Form::close() }}