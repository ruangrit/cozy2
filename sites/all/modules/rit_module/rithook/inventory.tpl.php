<?php
$search_name = '';
$search_phone = '';
if (isset($_GET['title'])) {
	$search_name  = $_GET['title'];
}
if (isset($_GET['phone'])) {
	$search_phone = $_GET['phone'];
}


?>

<div class="search-form container">
	<div class="row">
		<div class="col-xs-12 text-left text-center">
		<form method="GET">
			<div class="col-xs-4">
				<select name="order">
					<option value="">-FEATURE-</option>
					<option value="lth">Price - Low to High</option>
					<option value="htl">Price - High to Low</option>
					<option value="atz">Alphabetically - A to Z</option>
					<option value="zta">Alphabetically - Z to A</option>
					<option value="nto">Date - New to Old</option>
					<option value="otn">Date - Old to New</option>
				</select>
			</div>
			
			<?php
				$vocabulary = taxonomy_vocabulary_machine_name_load('product_category');
				$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
				dpm($terms);
			?>	
			<div class="col-xs-4 text-center">
				<select name="cat">
					<option value="">PRODUCT CATEGORY</option>

				</select>	
			</div>

			<div class="col-xs-4 text-center">
				<select name="cat">
					<option value="">PRODUCT CATEGORY</option>

				</select>	
			</div>

			<input type="submit" value="Search">
			</form>
		</div>

	</div>
</div>
<div class="marb20"></div>

<?php
global $user;
if ($user->uid == 0) {
	//print 'Login to view product.';
	//return false;
}
$nodes = node_load_multiple(array(), array('type' => 'products'));

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
			print '<div class="col-xs-4"><a href="'.$path.'">';
				print theme('image_style', 
					array('path' => $node->field_product_feature_image['und'][0]['uri'],
						'style_name' => 'product_list',
						'attributes' => array('class' => 'center'),
						)
					);
				
			print '</a></div>';

			print '<div class="col-xs-8">';

				print '<div class="code16">' . $node->field_product_code['und'][0]['value'] . '</div>';
				print '<div class="title18">' . $node->title . '</div>';
				print '<div class="normal16"> THB ' .number_format($node->field_product_price['und'][0]['value']).' </div>';

			print '</div>';
		print '</div>';
	print '</div>';
	$run_num++;
}




