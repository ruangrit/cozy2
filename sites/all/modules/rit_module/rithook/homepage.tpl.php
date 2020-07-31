<?php
global $user;
if ($user->uid == 0) {
	//print 'Login to view product.';
	//return false;
}
$nodes = node_load_multiple(array(), array('type' => 'products'));
foreach ($nodes as $node) {
	
	$path = drupal_get_path_alias('node/'.$node->nid);
	print '<div class="container" style="border-bottom: 1px solid #eee; padding-top: 20px;">';
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

				print '<div style="color: #98B8CA; font-size: 16px; line-height: 1.5em;">' . $node->field_product_code['und'][0]['value'] . '</div>';
				print '<div style="color: #666666; font-size: 18px; font-weight: bold; line-height: 1.5em;">PRODUCT NAME:</b> ' . $node->title . '</div>';
				print '<div style="color: #989898; font-size: 16px; line-height: 1.5em;"> THB ' .number_format($node->field_product_price['und'][0]['value']).' </div>';

			print '</div>';
		print '</div>';
	print '</div>';
}




