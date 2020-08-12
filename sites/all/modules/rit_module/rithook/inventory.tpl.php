<?php
$order = '';
$cat = '';
$color = '';
$mat = '';
$ava = '';
$sub_name = '';
$prd_name = '';
if (isset($_GET['order'])) {
	$order  = $_GET['order'];
}
if (isset($_GET['cat'])) {
	$cat = $_GET['cat'];
}

if (isset($_GET['color'])) {
	$color = $_GET['color'];
}
if (isset($_GET['mat'])) {
	$mat = $_GET['mat'];
}
if (isset($_GET['ava'])) {
	$ava = $_GET['ava'];
}
if (isset($_GET['sub_name'])) {
	$sub_name = $_GET['sub_name'];
}
if (isset($_GET['prd_name'])) {
	$prd_name = $_GET['prd_name'];
}

?>

<div class="search-form container">
	<div class="row">
		<div class="col-xs-12">
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
<!--############################################ Cat  -->			
			<?php
				$vocabulary = taxonomy_vocabulary_machine_name_load('product_category');
				$terms = taxonomy_get_tree($vocabulary->vid);
			?>	
			<div class="col-xs-4">
				<select name="cat">
					<option value="">PRODUCT CATEGORY</option>
					<?php
						foreach ($terms as $value) {
							if ($value->parents[0] == 0) {
								print '<option value="'.$value->tid.'">'.$value->name.'</option>';

							}
							else {
								print '<option value="'.$value->tid.'">-'.$value->name.'</option>';

							}
						}
					?>

				</select>	
			</div>
<!--############################################ End Cat  -->			
<!--############################################ Color  -->			
			<?php
				$vocabulary = taxonomy_vocabulary_machine_name_load('product_color');
				$terms = taxonomy_get_tree($vocabulary->vid);
			?>	
			<div class="col-xs-4">
				<select name="color">
					<option value="">Color</option>
					<?php
						foreach ($terms as $value) {
							if ($value->parents[0] == 0) {
								print '<option value="'.$value->tid.'">'.$value->name.'</option>';

							}
							else {
								print '<option value="'.$value->tid.'">-'.$value->name.'</option>';

							}
						}
					?>

				</select>	
			</div>
<!--############################################ End Cat  -->			

<!--############################################ Mat -->			
			<?php
				$vocabulary = taxonomy_vocabulary_machine_name_load('product_material');
				$terms = taxonomy_get_tree($vocabulary->vid);
			?>	
			<div class="col-xs-4">
				<select name="mat">
					<option value="">MATERIAL</option>
					<?php
						foreach ($terms as $value) {
							if ($value->parents[0] == 0) {
								print '<option value="'.$value->tid.'">'.$value->name.'</option>';

							}
							else {
								print '<option value="'.$value->tid.'">-'.$value->name.'</option>';

							}
						}
					?>

				</select>	
			</div>
<!--############################################ End Cat  -->			
			<div class="col-xs-4">
				<select name="ava">
					<option value="">AVAILABILITY</option>
					<option value="shop">Offline (Shop)</option>
					<option value="consignment">Offline (Consignment)</option>
					<option value="website">Online (Website)</option>
					<option value="others">Online (Others)</option>
					<option value="warehouse">Warehouse</option>
				</select>
			</div>
			<div class="col-xs-12">
				Supplise name: <input type="text" name="sub_name">
			</div>
			<div class="col-xs-12 marb20">

				Product name/code: <input type="text" name="prd_name">
			</div>

			<div><input type="submit" value="Search"></div>
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


$sql = '
	SELECT DISTINCT n.nid 
	FROM {node} n   
	LEFT JOIN {field_data_field_in_contact_number} ct
	ON n.nid = ct.entity_id
	WHERE (n.type = :type AND n.status = :status)
';

$params = array(':type'  => 'customers', ':status' => 1);



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




