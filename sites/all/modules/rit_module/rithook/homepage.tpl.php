<?php
global $user;
if ($user->uid == 0) {
	//print 'Login to view product.';
	//return false;
}
$nodes = node_load_multiple(array(), array('type' => 'products'));
foreach ($nodes as $node) {
	
	$path = drupal_get_path_alias('node/'.$node->nid);
	print '<div class="container">';
		print '<div class="row marb20">';
			print '<div class="col-xs-4"><a href="'.$path.'">';
				print theme('image_style', 
					array('path' => $node->field_product_feature_image['und'][0]['uri'],
						'style_name' => 'medium',
						'attributes' => array('class' => 'center'),
						)
					);
				
			print '</a></div>';

			print '<div class="col-xs-8">';
				print '<b>PRODUCT CODE:</b> ' . $node->field_product_code['und'][0]['value'];
				print '</br>';
				print '<b>PRODUCT NAME:</b> ' . $node->title;
				print '</br>';
				print '<b>PRICE:</b> ' .$node->field_product_price['und'][0]['value'].' THB';
			print '</div>';
		print '</div>';
	print '</div>';
}




