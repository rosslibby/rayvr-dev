		<div class="push"></div>
	</div>

	<div class="footer-fix bg-scheme-dark-gray">

		<div class="container text-center">

			<p class="fg-scheme-white lighter"><span>&copy; 2015 - RAYVR, LLC.</span> <span>{{ HTML::link('/resources/privacy', 'Privacy Policy', ['class' => 'fg-scheme-white']) }}</span><!-- <span>Terms & Conditions</span>--></p>

		</div>

	</div>

<!-- Load scripts -->
{{ HTML::script( 'resources/js/jquery.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap.min.js' ) }}
{{ HTML::script( 'resources/js/icheck.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.stepper.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.validate.min.js' ) }}
{{ HTML::script( 'resources/js/additional-methods.min.js' ) }}

<script>
$(document).ready(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red'
	});

	/** Send the invite via an ajax call **/
	$("#userInvite").submit(function(e){
		e.preventDefault();
		var email = $("input#email").val();
		var name = $("input#name").val();
		var code = $("input#invite_code").val();

		/** spin the cog as a progress indicator **/
		$('#sendInviteCog').addClass('fa-spin');

		$.ajax({
			type	: "POST",
			url 	: "sendinvite",
			headers	: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') },
			data	: { email: email, name: name, code: code },
			success	: function(data) {
				$('#sendInviteCog').removeClass('fa-spin');
				$('#successMsg').html(name + ' has been invited to RAYVR').fadeIn(400);
				$('#userInvite').find('input[type="text"]').val("");
				$('#userInvite').find('input[type="email"]').val("");
			}
		},"json");
	});

	/** Simulate generation of an invite code **/
	$('#generateInvite').click(function(){
		$('#loadingCog').addClass('fa-spin');
		setTimeout(function(){
			$('#loadingCog').removeClass('fa-spin');
			$('#invite').val($('#hiddenInvite').val());
		}, 2000);
	});
});
jQuery.validator.setDefaults({
	success: 'valid',
	error: 'error'
});
$("#businessRegistration").validate({
	rules: {
		email: {
			required: true,
			email: true
		}
	},
	rules: {
		password_confirmation: {
			required: true,
			minlength: 6,
			equalTo: password
		}
	},
	errorPlacement: function(error, element){
		return true;
	}
});
$("#userLogin").validate({
	rules: {
		email: {
			required: true,
			email: true
		}
	},
	rules: {
		password: {
			required: true,
			minlength: 6
		}
	},
	errorPlacement: function(error, element){
		return true;
	}
});
</script>

</body>
</html>