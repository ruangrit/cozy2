$ = jQuery;
$(document).ready(function() {

	$('#edit-field-product-code').hide();
	
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
	
	var code;
	var numberCode = 'XXXX';
	var shopCode = 'X';
	var subCatCode = 'XX';
	var prdNameCode = 'XXXXXXXXXX';
	var colorCode = 'XXX';
	var materialCode = 'XX';

	var shopId = '#edit-field-product-shop-und';
	var subCatId = '#edit-field-product-category-und-hierarchical-select-selects-1';
	var prdNameId = '#edit-title';
	var colorId = '#edit-field-product-color-und';
	var materialId = '#edit-field-product-material-und';
	var prdCodeID = '#edit-field-product-code-und-0-value';

	$(shopId).change(function () {
		render_product_code();
	});

	$(document).on('change', subCatId, function(){
    	render_product_code();
	});

	$(prdNameId).keyup(function () {
		render_product_code();
	});
	$(colorId).change(function () {
		render_product_code();
	});
	$(materialId).change(function () {
		render_product_code();
	});

	if ($(prdCodeID).val() == '') {
		render_product_code();
	}
	else {
		numberCode = $(prdCodeID).val().substring(0, 4);
	}
	function render_product_code() {

		if ($(shopId).val() != '_none') {
 			shopCode = $(shopId + ' option:selected').text();
 			shopCode = get_first_word(shopCode);
		}
		if (typeof $(subCatId).val() !== 'undefined' && $(subCatId).val() != 'label_1') {
 			subCatCode = $(subCatId + ' option:selected').text();
 			subCatCode = get_first_word(subCatCode);
		}
		if ($(prdNameId).val() != '') {
 			prdNameCode = $(prdNameId).val().substring(0, 10);
 			
		}
		if ($(colorId).val() != '_none') {
 			colorCode = $(colorId + ' option:selected').text();
 			colorCode = get_first_word(colorCode);
		}
		if ($(materialId).val() != '_none') {
 			materialCode = $(materialId + ' option:selected').text();
 			materialCode = get_first_word(materialCode);
		}
         
        code = numberCode + '-' + shopCode + '-' + subCatCode + '-' + prdNameCode + '-' + colorCode + '-' + materialCode;
        $('#edit-field-product-code-und-0-value').val(code);

	}

	function get_first_word(word) {
		var res = word.split("-");
		return res[0];
	}



});