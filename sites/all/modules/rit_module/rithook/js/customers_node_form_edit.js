$ = jQuery;
$(document).ready(function() {


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
		//==$('#edit-revision').prop('checked', true);
		//==$('#edit-revision').attr("disabled", true)

	}



});