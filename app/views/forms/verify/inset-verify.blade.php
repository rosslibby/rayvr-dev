<!-- User invite -->

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['route' => 'verify']) }}
		<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<p class="h3 raleway light fg-scheme-light" id="inviteAnother">Verify your account</p>
					<hr class="dashed">
					<br>
				</div>
			</div>
		</div>

			<div class="form-group required">
				<div class="input-group col-md-8 col-md-offset-2">
					{{ Form::text('code', null, ['id' => 'code', 'class' => 'form-control inset-form-input text-center', 'placeholder' => 'Code *']) }}
					<span class="input-group-addon"><i class="fa fa-ticket"></i></span>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<p id="successMsg" class="fg-scheme-white" style="display: none;"></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p><button type="submit" class="btn btn-info raleway larger light" id="sendInvite">Verify account</button></p>
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>