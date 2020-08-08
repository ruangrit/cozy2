$ = jQuery;
$(document).ready(function() {

	if ($('#field-p-coordinator-values').length == 0) {
		//console.log('click');
		$('#edit-field-p-coordinator-und-add-more > button').trigger('mousedown');

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