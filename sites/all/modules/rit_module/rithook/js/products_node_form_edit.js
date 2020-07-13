$ = jQuery;
$(document).ready(function() {


	$( document ).on( "keyup", "#edit-title", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", ".prd-qtn  input", function() {
		force_revision_new();
	});
	$( document ).on( "keyup", "#edit-field-product-price  input", function() {
		force_revision_new();
	});

	$( document ).on( "keyup", "#edit-field-product-cost  input", function() {
		force_revision_new();
	});

	function force_revision_new() {
		$('#edit-revision').prop('checked', true);
		$('#edit-revision').attr("disabled", true)

	}

});