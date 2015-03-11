<!-- Load scripts -->
{{ HTML::script( 'resources/js/jquery.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap.min.js' ) }}
{{ HTML::script( 'resources/js/icheck.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.stepper.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.selecter.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-datepicker.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-slider.js' ) }}

<script>


/**
 * Show file upload data to user
 */
$(document).on('change', '.btn-file :file', function() {
	$('#codeFileName').html(": <em>" + $(this).val().split("\\")[$(this).val().split("\\").length - 1] + "</em>");
});
$(document).ready(function(){

	var stripeResponseHandler = function(status, response) {
		var $form = $("#payment-form");

		if(response.error) {
			// Show the errors on the form
			$form.find('.payment-errors').text(response.error.message);
			$form.find('button').prop('disabled', false);
		} else {
			// token contains id, last4, and card type
			var token = response.id;
			// Insert the token into the form so it gets submitted to the server
			$form.append($('<input type="hidden" name="stripeToken" />').val(token));
			// and re-submit
			$form.get(0).submit();
		}
	};

	$('#payment-form').submit(function(event) {
		var $form = $(this);

		// Disable the submit button to prevent repeated clicks
		$form.find('button').prop('disabled', true);

		Stripe.card.createToken($form, stripeResponseHandler);

		// Prevent the form from submitting with the default action
		return false;
	});

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
				/* $("#description_input").html(data['description']); */
				$("#link_input").val(data['url']);

				/** Display the returned data **/
				$("#product-photo").attr('src', data['photo']);
				$("#product-title").html(data['title']);
				/* $("#product-description").attr('src', 'data:text/html;charset=utf-8,'+data['description']); */
				$("#product-url").attr('href', data['url']);
				$("#product-url").html('Product link ['+data['url']);
			}
		},"json");
	});
	
	/** Selecter **/
	$("select").selecter();

	/** Date range **/
	$('.input-daterange').datepicker();

	/** Free shipping = no cost to ship **/
	$("#free_shipping + ins").click(function(){
		$("#shippingCost").slideToggle();
	});

	/** Offer maximum slider **/
	var quotaSlider = $("#quotaSlider").slider({
		tooltip: 'always'
	});

	$("#quotaSlider").change(function(){
		$("#totalCost").html(quotaSlider.slider('getValue') * 5);
		$("#numOffers").html(quotaSlider.slider('getValue'));
	});
});
</script>

</body>
</html>