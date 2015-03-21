<!-- Load scripts -->
{{ HTML::script( 'resources/js/jquery.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap.min.js' ) }}
{{ HTML::script( 'resources/js/icheck.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.fs.stepper.min.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-datepicker.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-slider.js' ) }}
{{ HTML::script( 'resources/js/bootstrap-rating-input.js' ) }}
{{ HTML::script( 'resources/js/jquery.confirm.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.validate.min.js' ) }}
{{ HTML::script( 'resources/js/jquery.maskedinput.min.js' ) }}
<script>

/**
 * Show file upload data to user
 */
$(document).on('change', '.btn-file :file', function() {
	$('#codeFileName').html(": <em>" + $(this).val().split("\\")[$(this).val().split("\\").length - 1] + "</em>");
});
$(document).ready(function(){

	/** Simulate generation of an invite code **/
	$('#generateInvite').click(function(){
		$('#loadingCog').addClass('fa-spin');
		$('#inviteAnother').slideToggle();
		setTimeout(function(){
			$('#loadingCog').removeClass('fa-spin');
			/** This one keeps spinning when it shouldn't **/
			$('#sendInviteCog').removeClass('fa-spin');
			$('#invite').val($('#hiddenInvite').val());
			$('#invite').blur();
			$('#email').focus();
			$('#inviteAnother').html('Invite another friend!');
		}, 2000);
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

	$("#userInvite").validate({
		rules: {
			invite_code: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			name: {
				required: true
			}
		},
		errorPlacement: function(error, element){
			return true;
		}
	});

	/** Send the invite via an ajax call **/
	$("#userInvite").submit(function(e){
		e.preventDefault();

		/** This one keeps spinning when it shouldn't **/
		$('#sendInviteCog').removeClass('fa-spin');
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
				$('#inviteAnother').slideToggle();
			}
		},"json");
	});

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
				$("#asin_input").val(data['asin']);

				/** Display the returned data **/
				$("#product-photo").attr('src', data['photo']);
				$("#product-title").html(data['title']);
				/* $("#product-description").attr('src', 'data:text/html;charset=utf-8,'+data['description']); */
				$("#product-url").attr('href', data['url']);
				$("#product-url").html('Product link ['+data['url']);
			}
		},"json");
	});

	/** Date range **/
	var date = new Date();
	$('.input-daterange').datepicker({  startDate: new Date() });

	/** Free shipping = no cost to ship **/
	$("#shippingCost").hide();
	$("#shipFree ins").click(function(){
		if($("input[type=radio]").is(':checked')){
			$("#shippingCost").slideUp(400);
		}
	});
	$("#shipPaid ins").click(function(){
		if($("input[type=radio]").is(':checked')){
			$("#shippingCost").slideDown(400);
		}
	});
	// $("#free_shipping + ins").click(function(){
	// 	$("#shippingCost").slideToggle();
	// });

	/** Offer maximum slider **/
	var quotaSlider = $("#quotaSlider").slider({
		tooltip: 'always'
	});

	$("#quotaSlider").change(function(){
		$("#totalCost").html(quotaSlider.slider('getValue') * 5);
		$("#numOffers").html(quotaSlider.slider('getValue'));
	});

	/** Card number separator **/
	$("#card").mask("9999 - 9999 - 9999 - 9999");

	/** Validate feedback form upon submission **/
	$('#feedbackForm').submit(function(e){
		if(!$('#damage').is(':checked') && !$('#malfunction').is(':checked') && !$('#description').is(':checked')) {
			e.preventDefault();
			$('#issue').prepend('<p class="has-error">Please select at least one</p>');
			$('input[type="checkbox"]').closest('label').addClass('has-error');
		}
		if($('#rating').val() === '') {
			e.preventDefault();
			$('#pleaseRate').addClass('has-error');
		}
		if($('#feedbackExperience').val().length < 140) {
			e.preventDefault();
			$(this).addClass('has-error');
			$('#experience').addClass('has-error');
		}
	});

	/** 140 character minimum **/
	$('#feedbackExperience').keyup(function(){
		if($(this).val().length <= 140){
			$('#moreFeedback').show();
			$('#moreFeedback').html('You need <em>at least</em> <strong>' + (140 - ($(this).val().length)) + ' more</strong> characters');
		} else {
			$('#moreFeedback').html('You need <em>at least</em> <strong>0 more</strong> characters');
			$('#moreFeedback').hide();
		}
	});

	/** validate preferences (user) **/
	$('#preferences').submit(function(e) {
		if($('#firstName').val() === '' || $('#firstName').val() == ' ') {
			e.preventDefault();
			$('#firstName').addClass('bg-scheme-dark');
			$('#firstName').focus();
		} else {
			$('#firstName').removeClass('bg-scheme-dark');
		}
		if($('#lastName').val() === '' || $('#lastName').val() == ' ') {
			e.preventDefault();
			$('#lastName').addClass('bg-scheme-dark');
			$('#lastName').focus();
		} else {
			$('#lastName').removeClass('bg-scheme-dark');
		}
		if($('#email').val() === '' || $('#email').val() == ' ') {
			e.preventDefault();
			$('#email').addClass('bg-scheme-dark');
			$('#email').focus();
		} else {
			$('#email').removeClass('bg-scheme-dark');
		}
		if($('#profile').val() === '' || $('#profile').val() == ' ') {
			e.preventDefault();
			$('#profile').addClass('bg-scheme-dark');
			$('#profile').focus();
		} else {
			$('#profile').removeClass('bg-scheme-dark');
		}
		if(($('#profile').val().indexOf('http://www.amazon.com/gp/profile/') === -1) && ($('#profile').val().indexOf('https://www.amazon.com/gp/profile/') === -1)) {
			e.preventDefault();
			if(!$('#profile').hasClass('follow-directions')) {
				$('#profile_group').prepend('<div class="col-md-10 col-md-offset-1"><div class="alert alert-danger"><p class="h4 light">Follow the instructions below to find your Amazon&trade; profile URL.</p></div></div>');
			}
			$('#profile').addClass('bg-scheme-dark follow-directions');
			$('#profile').focus();
		} else {
			$('#profile').removeClass('bg-scheme-dark follow-directions');
		}
		if($('#address').val() === '' || $('#address').val() == ' ') {
			e.preventDefault();
			$('#address').addClass('bg-scheme-dark');
			$('#address').focus();
		} else {
			$('#address').removeClass('bg-scheme-dark');
		}
		if($('#city').val() === '' || $('#city').val() == ' ') {
			e.preventDefault();
			$('#city').addClass('bg-scheme-dark');
			$('#city').focus();
		} else {
			$('#city').removeClass('bg-scheme-dark');
		}
		if($('#zip').val() === '' || $('#zip').val() == ' ') {
			e.preventDefault();
			$('#zip').addClass('bg-scheme-dark');
			$('#zip').focus();
		} else {
			$('#zip').removeClass('bg-scheme-dark');
		}
	});

	/** validate preferences (business) **/
	$('#businessPreferences').submit(function(e) {
		if($('#firstName').val() === '' || $('#firstName').val() == ' ') {
			e.preventDefault();
			$('#firstName').removeClass('subtle-input');
			$('#firstName').addClass('bg-scheme-dark');
			$('#firstName').focus();
		} else {
			$('#firstName').addClass('subtle-input');
			$('#firstName').removeClass('bg-scheme-dark');
		}
		if($('#lastName').val() === '' || $('#lastName').val() == ' ') {
			e.preventDefault();
			$('#lastName').removeClass('subtle-input');
			$('#lastName').addClass('bg-scheme-dark');
			$('#lastName').focus();
		} else {
			$('#lastName').addClass('subtle-input');
			$('#lastName').removeClass('bg-scheme-dark');
		}
		if($('#email').val() === '' || $('#email').val() == ' ') {
			e.preventDefault();
			$('#email').removeClass('subtle-input');
			$('#email').addClass('bg-scheme-dark');
			$('#email').focus();
		} else {
			$('#email').addClass('subtle-input');
			$('#email').removeClass('bg-scheme-dark');
		}
		if($('#address').val() === '' || $('#address').val() == ' ') {
			e.preventDefault();
			$('#address').removeClass('subtle-input');
			$('#address').addClass('bg-scheme-dark');
			$('#address').focus();
		} else {
			$('#address').addClass('subtle-input');
			$('#address').removeClass('bg-scheme-dark');
		}
		if($('#city').val() === '' || $('#city').val() == ' ') {
			e.preventDefault();
			$('#city').removeClass('subtle-input');
			$('#city').addClass('bg-scheme-dark');
			$('#city').focus();
		} else {
			$('#city').addClass('subtle-input');
			$('#city').removeClass('bg-scheme-dark');
		}
		if($('#zip').val() === '' || $('#zip').val() == ' ') {
			e.preventDefault();
			$('#zip').removeClass('subtle-input');
			$('#zip').addClass('bg-scheme-dark');
			$('#zip').focus();
		} else {
			$('#zip').addClass('subtle-input');
			$('#zip').removeClass('bg-scheme-dark');
		}
		if($('#phone').val() === '' || $('#phone').val() == ' ') {
			e.preventDefault();
			$('#phone').removeClass('subtle-input');
			$('#phone').addClass('bg-scheme-dark');
			$('#phone').focus();
		} else {
			$('#phone').addClass('subtle-input');
			$('#phone').removeClass('bg-scheme-dark');
		}
	});

	/** prevent accidental account deactivation **/
	$('#deactivateAccount').click(function(e) {
		e.preventDefault();
		$.confirm({
			text: 'This will deactivate your account. You will have to contact support if you wish to re-activate your account. Are you sure you want to proceed?',
			confirm: function() {
				$('#deactivate').submit();
			},
			cancel: function() {
				// do nothing
			}
		});
	});
});
</script>

</body>
</html>