$ = jQuery;
$(document).ready(function() {
	$('.group-name').children().addClass('col-xs-4');

	$('.group-customer-birth').children().addClass('col-xs-4');

	/*$('#field-email-values').find('input').each(function( index ) {
  		//console.log( index + ": " + $( this ).text() );
  		$(this).on( "blur", function() {
  			console.log( $( this ).val() );
		});
	});
	$('input').on( "blur", function() {
  			console.log( $( this ).val() );
	});
	*/

$( document ).on( "blur", "#edit-field-email  input", function() {
	if( !validateEmail($( this ).val()) ) {

		$('#edit-field-email').before('<div class="alert alert-block alert-dismissible alert-danger messages error"><a class="close" data-dismiss="alert" href="#">×</a><h4 class="element-invisible">Error message</h4>'+ $(this).val() +' is not a valid email address</div>');
	}
});

	function validateEmail($email) {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  	return emailReg.test( $email );
	}
});