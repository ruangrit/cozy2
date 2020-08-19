$ = jQuery;
$(document).ready(function() {
	
	var getUrlParameter = function getUrlParameter(sParam) {
	    var sPageURL = window.location.search.substring(1),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
	        }
	    }
	};

	var csf = getUrlParameter('csf');
	if (csf == 'web' || csf == 'shop') {
		$('.multiple-fields-remove-button').hide();
		$('.field-add-more-submit').hide();
	}

	if (window.location.pathname == '/node/add/customers') {

		if(csf == 'web' || csf == 'shop') {
			$('h1').html('<div class="heading1">Join&nbsp;</div><div class="heading2">A Pleasure of Relaxing in Style</div>');
			$('.page-header').addClass('marb50');

		}
	}
	else {


		$( document ).on( "keyup", "#edit-field-email  input", function() {
			force_revision_new();
		});

		$( document ).on( "keyup", "#edit-field-in-contact-number  input", function() {
			force_revision_new();
		});

		$( document ).on( "keyup", "#edit-field-customer-address  input", function() {
			force_revision_new();
		});
		$('#edit-field-customer-address select').on('change', function() {
			force_revision_new();
		});

		function force_revision_new() {
			$('#edit-revision').prop('checked', true);
			$('#edit-revision').attr("disabled", true)

		}

	}

	$('.group-name').children().addClass('col-xs-4');

	$('.group-customer-birth').children().addClass('col-xs-4');


	$( document ).on( "blur", "#edit-field-email  input", function() {
		$('.error-email').remove();
		if( !validateEmail($( this ).val()) ) {

			$('#edit-field-email').before('<div class="alert alert-block alert-dismissible alert-danger messages error error-email"><a class="close" data-dismiss="alert" href="#">×</a><h4 class="element-invisible">Error message</h4>'+ $(this).val() +' is not a valid email address</div>');
		}
	});

	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  	return emailReg.test( $email );
	}








});