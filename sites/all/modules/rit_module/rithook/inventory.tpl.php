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

$sql_select = '
	SELECT DISTINCT n.nid 
	FROM {node} n   
	
';

$sql_join = '';
$sql_where = ' WHERE (n.type = :type AND n.status = :status) ';
$sql_order = '';

$params = array(':type'  => 'products', ':status' => 1);

// product name, code
if ($prd_name != '') {
	$sql_join .= '
		LEFT JOIN {field_data_field_product_code} code
		ON n.nid = code.entity_id
	';
	$sql_where .= ' AND  (n.title LIKE :prd_name OR code.field_product_code_value LIKE :prd_name)';
	$params[':prd_name'] = '%'.$prd_name.'%';
}

// supplier
if ($sub_name != '') {
	$sql_join .= ' 
		LEFT JOIN {field_data_field_product_supplier} p_supplier
		ON n.nid = p_supplier.entity_id
		LEFT JOIN {node} n2
		ON p_supplier.field_product_supplier_target_id = n2.nid
	';
	$sql_where .= ' AND n2.title LIKE :sub_name';
	$params[':sub_name'] = '%'.$sub_name.'%';
}

// avaliable
if ($ava != '') {
	if ($ava == 'shop') {
		$sql_join .= '
			LEFT JOIN {field_data_field_prd_qty_offline_shop} ava 
			ON n.nid = ava.entity_id
		';
		$sql_where .= ' AND ava.field_prd_qty_offline_shop_value > 0 ';
	}
	else if ($ava == 'consignment') {
		$sql_join .= '
			LEFT JOIN {field_data_field_prd_offline_consignment} ava 
			ON n.nid = ava.entity_id
		';
		$sql_where .= ' AND ava.field_prd_offline_consignment_value > 0 ';

	}
	else if ($ava == 'website') {
		$sql_join .= '
			LEFT JOIN {field_data_field_prd_qty_online_website} ava
			ON n.nid = ava.entity_id
		';
		$sql_where .= ' AND ava.field_prd_qty_online_website_value > 0 ';

	}
	else if ($ava == 'others') {
		$sql_join .= '
			LEFT JOIN {field_data_field_prd_qty_online_others} ava
			ON n.nid = ava.entity_id
		';
		$sql_where .= ' AND ava.field_prd_qty_online_others_value > 0 ';

	}
	else if ($ava == 'warehouse') {
		$sql_join .= '
			LEFT JOIN {field_data_field_prd_qty_warehouse} ava
			ON n.nid = ava.entity_id
		';
		$sql_where .= ' AND ava.field_prd_qty_warehouse_value > 0 ';

	}
}


// material 
if($mat != '') {
	$sql_join .= '

		LEFT JOIN {field_data_field_product_material} mat
		ON n.nid = mat.entity_id
	';

	$sql_where .= ' AND mat.field_product_material_tid = :mat ';
	$params[':mat'] = $mat;
}

// color 
if($color != '') {
	$sql_join .= '
		LEFT JOIN {field_data_field_product_color} color
		ON n.nid = color.entity_id
	';
	$sql_where .= ' AND color.field_product_color_tid = :color ';
	$params[':color'] = $color;
}

// cat filter
if($cat != '') {
	$sql_join .= '
		LEFT JOIN {field_data_field_product_category} pc
		ON n.nid = pc.entity_id
		LEFT JOIN {taxonomy_term_hierarchy} pt
		ON pc.field_product_category_tid = pt.tid
		LEFT JOIN {taxonomy_term_data} ptd
		ON pt.parent = ptd.tid
	';
	$sql_where .= ' AND (pc.field_product_category_tid = :cat OR ptd.tid = :cat)';
	$params[':cat'] = $cat;
}


// order
if($order != '') {
	if ($order == 'lth') {
		$sql_join .= '
			LEFT JOIN {field_data_field_product_price} pp
			ON n.nid = pp.entity_id
		';
		$sql_order .= ' ORDER BY pp.field_product_price_value ASC';
	}
	else if ($order == 'htl') {
		$sql_join .= '
			LEFT JOIN {field_data_field_product_price} pp
			ON n.nid = pp.entity_id
		';
		$sql_order .= ' ORDER BY pp.field_product_price_value DESC';
	}
	else if ($order == 'atz') {
		$sql_order .= ' ORDER BY n.title ASC';
	}
	else if ($order == 'zta') {
		$sql_order .= ' ORDER BY n.title DESC';
	}
	else if ($order == 'nto') {
		$sql_order .= ' ORDER BY n.created ASC';
	}
	else if ($order == 'otn') {
		$sql_order .= ' ORDER BY n.created DESC';
	}
}


$sql = $sql_select.$sql_join.$sql_where.$sql_order;

$result = db_query($sql, $params);

$nids = array();
foreach ($result as $record) {
	$nids[] = $record->nid;
}


?>

<div class="search-form container">
	<div class="row">
		<div class="col-xs-12">
		<form method="GET">
			<div class="col-xs-4 marb20">
				<select name="order">
					<option value="" <?php if($order == ""){print "selected";}?>>-- FEATURE --</option>
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
			<div class="col-xs-4 marb20">
				<select name="cat">
					<option value="">-- PRODUCT CATEGORY --</option>
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
			<div class="col-xs-4 marb20">
				<select name="color">
					<option value="">-- Color --</option>
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
			<div class="col-xs-4 marb20">
				<select name="mat">
					<option value="">-- MATERIAL --</option>
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
			<div class="col-xs-8 marb20">
				<select name="ava">
					<option value="" <?php if($ava == ""){print "selected";}?> >-- AVAILABILITY --</option>
					<option value="shop" <?php if($ava == "shop"){print "selected";}?> >Offline (Shop)</option>
					<option value="consignment" <?php if($ava == "consignment"){print "selected";}?> >Offline (Consignment)</option>
					<option value="website" <?php if($ava == "website"){print "selected";}?> >Online (Website)</option>
					<option value="others" <?php if($ava == "others"){print "selected";}?> >Online (Others)</option>
					<option value="warehouse" <?php if($ava == "warehouse"){print "selected";}?> >Warehouse</option>
				</select>
			</div>
			<div class="col-xs-4 marb20">
				Supplier name: <input type="text" name="sub_name" value="<?php print $sub_name;?>">
			</div>
			<div class="col-xs-4 marb20">

				Product name/code: <input type="text" name="prd_name" value="<?php print $prd_name;?>">
			</div>

			<div class="col-xs-4 marb20">

				<input type="submit" value="Search">
				<input type="reset" value="Reset" onclick="window.location = 'inventory';">

			</div>

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





