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

$sql = '
	SELECT DISTINCT n.nid 
	FROM {node} n   
	LEFT JOIN {field_data_field_product_price} pp
	ON n.nid = pp.entity_id

	LEFT JOIN {field_data_field_product_category} pc
	ON n.nid = pc.entity_id
	LEFT JOIN {taxonomy_term_hierarchy} pt
	ON pc.field_product_category_tid = pt.tid
	LEFT JOIN {taxonomy_term_data} ptd
	ON pt.parent = ptd.tid

	LEFT JOIN {field_data_field_product_color} color
	ON n.nid = color.entity_id

	LEFT JOIN {field_data_field_product_material} mat
	ON n.nid = mat.entity_id

	WHERE (n.type = :type AND n.status = :status)
';

$params = array(':type'  => 'products', ':status' => 1);

// material 
if($mat != '') {
	$sql .= ' AND mat.field_product_material_tid = :mat ';
	$params[':mat'] = $mat;
}

// color 
if($color != '') {
	$sql .= ' AND color.field_product_color_tid = :color ';
	$params[':color'] = $color;
}

// cat filter
if($cat != '') {
	$sql .= ' AND (pc.field_product_category_tid = :cat OR ptd.tid = :cat)';
	$params[':cat'] = $cat;
}


// order
if($order != '') {
	if ($order == 'lth') {
		$sql .= ' ORDER BY pp.field_product_price_value ASC';
	}
	else if ($order == 'htl') {
		$sql .= ' ORDER BY pp.field_product_price_value DESC';
	}
	else if ($order == 'atz') {
		$sql .= ' ORDER BY n.title ASC';
	}
	else if ($order == 'zta') {
		$sql .= ' ORDER BY n.title DESC';
	}
	else if ($order == 'nto') {
		$sql .= ' ORDER BY n.created ASC';
	}
	else if ($order == 'otn') {
		$sql .= ' ORDER BY n.created DESC';
	}
}



$result = db_query($sql, $params);

$nids = array();
foreach ($result as $record) {
	$nids[] = $record->nid;
}
dpm($nids);


?>

<div class="search-form container">
	<div class="row">
		<div class="col-xs-12">
		<form method="GET">
			<div class="col-xs-4">
				<select name="order">
					<option value="" <?php if($order == ""){print "selected";}?>>-FEATURE-</option>
					<option value="lth" <?php if($order == "lth"){print "selected";}?> >Price - Low to High</option>
					<option value="htl" <?php if($order == "htl"){print "selected";}?> >Price - High to Low</option>
					<option value="atz" <?php if($order == "atz"){print "selected";}?> >Alphabetically - A to Z</option>
					<option value="zta" <?php if($order == "zta"){print "selected";}?> >Alphabetically - Z to A</option>
					<option value="nto" <?php if($order == "nto"){print "selected";}?> >Date - New to Old</option>
					<option value="otn" <?php if($order == "otn"){print "selected";}?> >Date - Old to New</option>
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
								print '<option ';
								if ($value->tid == $cat) {print ' selected ';}
								print ' value="'.$value->tid.'" >'.$value->name.'</option>';

							}
							else {
								print '<option ';
								if ($value->tid == $cat) {print ' selected ';}
								print ' value="'.$value->tid.'">-'.$value->name.'</option>';

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
							
							print '<option';
							if ($value->tid == $color) {print ' selected ';}
							print ' value="'.$value->tid.'">'.$value->name.'</option>';
							
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

							print '<option';
							if ($value->tid == $mat) {print ' selected ';}
							print ' value="'.$value->tid.'">'.$value->name.'</option>';

							
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



if(count($nids) == 0) {
	print '-- No data ---';
}
else {


		//pagger
	$per_page = 3;
	$current_page = pager_default_initialize(count($nids), $per_page);
	$chunks = array_chunk($nids, $per_page, TRUE);
	$total_node = count($nids);


	$nodes = node_load_multiple($chunks[$current_page]);

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
	print theme('pager', array('quantity', count($nodes)));


}





