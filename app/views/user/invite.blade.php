@extends('includes.user-nav')

@section('content')
<p class="h3 raleway lighter text-center">
	Invite your friends
	<br>
	<br>
	<span class="icon-hollow icon-invite"></span>
</p>

<!-- Description for page -->
		<div class="col-md-12 text-center">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<p class="raleway more-height h5 light">
								Invite your friends! There's enough for everyone!
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- The form -->

<br>
<br>
<br>
@stop

@section('out-container')
<div class="inset-form-container row-dark-blue">
	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				@include('forms.invite.inset-invite')
				@if(Session::has('error'))
					<br>
					<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						{{ Session::get('error') }}
						<strong>Try again</strong> or <strong>{{ HTML::link('register', 'Sign up') }}</strong>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop