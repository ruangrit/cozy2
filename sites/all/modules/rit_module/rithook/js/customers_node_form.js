$ = jQuery;
$(document).ready(function() {

	if (window.location.pathname == '/node/add/customers') {
		$('h1').html('<span style="color:#2196f3; font-size: 35px;">Join The Pleasure</span> of relaxing instyle');

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





});