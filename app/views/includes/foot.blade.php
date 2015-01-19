		<div class="push"></div>
	</div>

	<div class="footer-fix footer-bg-dark">

		<div class="container text-center">

			<p class="fg-scheme-white lighter"><span>&copy; 2015 - RAYVR, LLC.</span> <span>Privacy Policy</span> <span>Terms & Conditions</span></p>

		</div>

	</div>

<!-- Load scripts -->
{{ HTML::script( 'resources/js/jquery.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap.min.js' ) }}
{{ HTML::script( 'resources/js/icheck.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.stepper.min.js' ) }}

<script>
$(document).ready(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox_flat-red',
		radioClass: 'iradio_flat-red'
	});
});
</script>

</body>
</html>