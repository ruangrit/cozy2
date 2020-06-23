$ = jQuery;
$(document).ready(function() {

	var code;
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
	render_product_code();
	function render_product_code() {

		if ($(shopId).val() != '_none') {
 			shopCode = $(shopId + ' option:selected').text().substring(0, 1);
		}
		if (typeof $(subCatId).val() !== 'undefined' && $(subCatId).val() != 'label_1') {
 			subCatCode = $(subCatId + ' option:selected').text().substring(0, 2);
		}
		if ($(prdNameId).val() != '') {
 			prdNameCode = $(prdNameId).val().substring(0, 10);
		}
		if ($(colorId).val() != '_none') {
 			colorCode = $(colorId + ' option:selected').text().substring(0, 3);
		}
		if ($(materialId).val() != '_none') {
 			materialCode = $(materialId + ' option:selected').text().substring(0, 2);
		}
         
        code = 'XXXX-' + shopCode + '-' + subCatCode + '-' + prdNameCode + '-' + colorCode + '-' + materialCode;
        $('#edit-field-product-code-und-0-value').val(code);

	}



});