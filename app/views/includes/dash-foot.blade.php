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

	$('[data-toggle="tooltip"]').tooltip();

	$("#fetch").submit(function(e){
		e.preventDefault();
		var url = $("input#url").val();
		$.ajax({
			type	: "POST",
			url 	: "fetch",
			headers	: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') },
			data	: { url: url },
			success	: function(data){
				console.log(data);
			}
		},"json");
	});
});
</script>

</body>
</html>