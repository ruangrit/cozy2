$ = jQuery;
$(document).ready(function() {

	$('.group-col2').children().addClass('col-xs-6');

	if ($('#field-p-coordinator-values').length == 0) {

		console.log('click');
		$('#edit-field-p-coordinator-und-add-more').find('button').trigger('mousedown');

	}

	$('#edit-field-p-coordinator').find('button').click(function () {

		console.log('sssss');
	});

	$('body').on('DOMNodeInserted', '.field-name-field-p-coordinator', function () {
      	
      	$('.group-col2').children().addClass('col-xs-6');
		//console.log('aaaa');
	});

	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});


	if (window.location.pathname != '/node/add/suppliers') {
		
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
	}
});