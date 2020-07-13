$ = jQuery;
$(document).ready(function() {
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