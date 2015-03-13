<!-- User invite -->
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		{{ Form::open(['', 'id' => 'userInvite']) }}

			<div class="form-group required row">
				<div class="col-md-7">
					<div class="input-group">
						{{--*/ $inviteCode = Auth::user()->invite_code /*--}}
						{{ Form::hidden('hiddenInvite', $inviteCode, ['id' => 'hiddenInvite']) }}
						{{ Form::text('invite_code', null, ['id' => 'invite', 'class' => 'form-control inset-form-input']) }}
						<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
					</div>
				</div>
				<div class="col-md-5 text-right">
					<i class="fa fa-cog fg-scheme-white" id="loadingCog"></i>&nbsp;&nbsp;{{ Form::button('Generate Invite Code', ['id' => 'generateInvite', 'class' => 'btn btn-info raleway light']) }}
				</div>
			</div>

			<div class="form-group required">
				<div class="input-group">
					{{ Form::email('email', null, ['id' => 'email', 'class' => 'form-control inset-form-input', 'placeholder' => 'Email *']) }}
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
			
			<div class="form-group required">
				<div class="input-group">
					{{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control inset-form-input', 'placeholder' => 'Name *']) }}
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-md-8">
					<p id="successMsg" class="fg-scheme-white" style="display: none;"></p>
				</div>
				<div class="col-md-4 text-right">
					<button type="submit" class="btn btn-info raleway larger light" id="sendInvite"><i class="fa fa-cog" id="sendInviteCog"></i>&nbsp;&nbsp;Send Invite&nbsp;&nbsp;<i class="fa fa-send"></i></button>
				</div>
			</div>

		{{ Form::close() }}
	</div>
</div>