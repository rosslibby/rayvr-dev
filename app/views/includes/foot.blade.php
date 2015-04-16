		<div class="push"></div>
	</div>

	<div class="footer-fix bg-scheme-dark-gray">

		<div class="container text-center">

			<p class="fg-scheme-white lighter"><span>&copy; 2015 - RAYVR, LLC.</span> <span>{{ HTML::link('resources/privacy', 'Privacy Policy', ['class' => 'fg-scheme-white']) }}</span> <span>{{ HTML::link('faq', 'FAQ\'s', ['class' => 'fg-scheme-white']) }}</span><!-- <span>Terms & Conditions</span>--></p>

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

	$('#scrollDown').click(function(){
		$('html, body').animate({
			scrollTop: $("#pageInfo").offset().top
		}, 800);
	});
});

$("#businessRegistration").validate({
	rules: {
		email: {
			required: true,
			email: true
		},
		password: {
			required: true,
			minlength: 6,
		},
		agree: {
			required: true
		}
	},
	errorPlacement: function(error, element){
		return true;
	}
});
$("#inlineRegistration").validate({
	rules: {
		email: {
			required: true,
			email: true
		},
		password: {
			required: true,
			minlength: 6
		},
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
		},
		password: {
			required: true,
			minlength: 6
		}
	},
	errorPlacement: function(error, element){
		return true;
	}
});
$('#businessRegistration').submit(function(e){
	if(!$('#agree').is(':checked')) {
		var styles = {
			background: 'rgba(0, 0, 0, .3)',
			border: '1px solid rgba(250, 0, 0, .4)',
			padding: '10px'
		};
		$('.checkbox').css(styles);
	}
});
</script>

</body>
</html>