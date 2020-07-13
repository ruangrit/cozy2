$ = jQuery;
$(document).ready(function() {


	$( document ).on( "keyup", "#edit-title", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", "#edit-field-tax-number  input", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", "#edit-field-email  input", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", "#edit-field-contact-number  input", function() {
		force_revision_new();
	});

	$( document ).on( "change keyup paste", "#edit-field-supplier-head-office  textarea", function() {
		force_revision_new();
	});
	$('#edit-field-customer-address select').on('change', function() {
		force_revision_new();
	});

	$( document ).on( "keyup", ".field-name-field-p-name  input", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", ".field-name-field-p-email  input", function() {
		force_revision_new();
	});

	function force_revision_new() {
		$('#edit-revision').prop('checked', true);
		$('#edit-revision').attr("disabled", true)

	}

});