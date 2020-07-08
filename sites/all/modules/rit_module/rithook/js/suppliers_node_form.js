$ = jQuery;
$(document).ready(function() {

	if ($('#field-p-coordinators-values').length == 0) {

		$('#edit-field-p-coordinators-und-add-more > button').trigger('mousedown');

	}


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
});