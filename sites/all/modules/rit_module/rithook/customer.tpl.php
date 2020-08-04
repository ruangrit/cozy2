<?php
global $user;
if ($user->uid == 0) {
	//print 'Login to view product.';
	//return false;
}
$nodes = node_load_multiple(array(), array('type' => 'customers'));

$total_node = count($nodes);
$run_num = 1;
foreach ($nodes as $node) {
	
	$path = drupal_get_path_alias('node/'.$node->nid);
	if ($run_num == $total_node) {
		print '<div class="container" style="padding-top: 20px;">';
	}
	else {
		print '<div class="container" style="border-bottom: 1px solid #eee; padding-top: 20px;">';

	}
		print '<div class="row marb20">';
			

			print '<div class="col-xs-12">';
				$email = rit_hook_display_multiple_comma($node->field_email['und']);
				print '<div class="code14">' . $node->field_customer_code['und'][0]['value'] . '</div>';

				$title_item = field_view_field('node', $node, 'field_title'); 
				print '<div class="title16">' .$title_item[0]['#markup'].' '. $node->title .' '. $node->field_last_name['und'][0]['value']. '</div>';

				print '<div class="normal14">' .$email.' </div>';
				print '<a href="'.$path.'" class="normal14"><b>Read more...</b></a>';

			print '</div>';
		print '</div>';
	print '</div>';
	$run_num++;
}




