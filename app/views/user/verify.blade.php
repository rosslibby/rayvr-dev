@extends('includes.user-nav')

@section('content')
<p class="h3 raleway lighter text-center">
	<i class="fa fa-ticket"></i> You need to verify your account before you can proceed.
	<br>
	<br>
</p>

<!-- Description for page -->
		<div class="col-md-12 text-center">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							@if(Session::has('success'))
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<strong>Success!</strong> {{ Session::get('success') }}
							</div>
							@endif
							<p class="raleway more-height h5 light">
								<i class="fa fa-envelope"></i> We sent you an email with a verification link. Click the link to gain access to RAYVR.
								<br>
								<br>
								<strong>If you haven't received your account confirmation email, <a href="user/sendconfirm">click here</a> to resend it.</strong>
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
@stop