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
});