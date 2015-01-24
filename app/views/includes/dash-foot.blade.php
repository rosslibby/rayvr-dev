<!-- Load scripts -->
{{ HTML::script( 'resources/js/jquery.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap.min.js' ) }}
{{ HTML::script( 'resources/js/icheck.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.stepper.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-datepicker.js' ) }}

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

		/** Run the loading bar animation **/
		var progress = 1;
		var progressLimit = 80;
		var howFast = 150;
		fillProgress = setInterval(function(){
			if(progress <= progressLimit){
				$("#progress").css('width', progress + '%');
				$("#progress > span").html(progress+'% Complete');
				$("#progress").attr('aria-valuenow', progress);
				$("#progress-container").attr('data-original-title', 'Progress ('+progress+'%)');
			}
			if(progress == 34){
				howFast = 300;
			}
			progress++;
		}, howFast);
		$.ajax({
			type	: "POST",
			url 	: "fetch",
			headers	: { 'X-CSRF-Token' : $('meta[name="_token"]').attr('content') },
			data	: { url: url },
			success	: function(data){

				/** Fill in the progress bar **/
				progressLimit = 100;
				fillProgress = setInterval(function(){
					if(progress <= progressLimit){
						$("#progress").css('width', progress + '%');
						$("#progress > span").html(progress+'% Complete');
						$("#progress").attr('aria-valuenow', progress);
						$("#progress-container").attr('data-original-title', 'Progress ('+progress+'%)');
					}
					progress++;
				}, 3);

				// Log the data temporarily
				console.log(data);

				/** Popluate the form with the returned data **/
				$("#photo_input").val(data['photo']);
				$("#title_input").val(data['title']);
				$("#description_input").html(data['description']);
				$("#link_input").val(data['url']);

				/** Display the returned data **/
				$("#product-photo").attr('src', data['photo']);
				$("#product-title").html(data['title']);
				$("#product-description").attr('src', 'data:text/html;charset=utf-8,'+data['description']);
				$("#product-url").attr('href', data['url']);
				$("#product-url").html('Product link ['+data['url']);
			}
		},"json");
	});
	
	/** Selecter **/
	$("select").selecter();

	/** Date range **/
	$('.input-daterange').datepicker();
});
</script>

</body>
</html>