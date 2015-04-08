<!-- User invite -->

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['', 'id' => 'userInvite']) }}

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<p class="h3 raleway light fg-scheme-light" id="inviteAnother">Invite a friend!</p>
					<hr class="dashed">
					<br>
				</div>
			</div>
			<div class="row text-center">
				<button class="btn btn-info" id="share" style="background-color: #376BBC; border-color: #376BBC;"><i class="fa fa-facebook"></i>&nbsp;&nbsp;<span class="lighter">Share</span></button>
				<br>
				<br>
			</div>
			<div class="form-group required row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<p class="fg-scheme-white light"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Or invite using email <i class="fa fa-arrow-circle-down"></i></p>
					<button id="generateInvite" type="button" class="btn btn-info raleway light h4"><i class="fa fa-cog fg-scheme-white" id="loadingCog"></i>&nbsp;&nbsp;Generate Invite Code</button>
				</div>
				<div class="col-md-8 col-md-offset-2">
					<br>
					<br>
					<p class="fg-scheme-white text-center light">...to generate this code <i class="fa fa-arrow-circle-down"></i></p>
					<div class="input-group">
						{{--*/ $inviteCode = Auth::user()->invite_code /*--}}
						{{ Form::hidden('hiddenInvite', $inviteCode, ['id' => 'hiddenInvite']) }}
						{{ Form::text('invite_code', null, ['id' => 'invite', 'class' => 'form-control inset-form-input text-center', 'placeholder' => 'XXXXXXXXXXXX']) }}
						<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
					</div>
				</div>
			</div>

			<div class="form-group required">
				<div class="input-group col-md-8 col-md-offset-2">
					{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input text-center', 'placeholder' => 'Email *']) }}
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
			
			<div class="form-group required">
				<div class="input-group col-md-8 col-md-offset-2">
					{{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control inset-form-input text-center', 'placeholder' => 'Name *']) }}
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
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
					<p><button type="submit" class="btn btn-info raleway larger light" id="sendInvite"><i class="fa fa-cog" id="sendInviteCog"></i>&nbsp;&nbsp;Send Invite&nbsp;&nbsp;<i class="fa fa-send"></i></button></p>
					<p>{{ HTML::link('offers/current', 'Skip to Offers', ['class' => 'btn btn-primary raleway larger light']) }}</p>
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>