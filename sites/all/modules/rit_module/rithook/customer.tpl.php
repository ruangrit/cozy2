<?php

// search value

$search_name = '';
$search_phone = '';
if (isset($_GET['title'])) {
	$search_name  = $_GET['title'];
}
if (isset($_GET['field_in_contact_number'])) {
	$search_phone = $_GET['field_in_contact_number'];
}


?>

<div class="search-form container">
	<div class="row">
		<div class="col-xs-12 text-right">
		<form method="GET">
			<b>Search customer by:</b>
		
			
				Name: <input type="text" name="title" value="<?php print $search_name;?>">
				Contact number: <input type="text" name="field_in_contact_number" value="<?php print $search_phone; ?>">
				<input type="submit" value="Search">
			</form>
		</div>

	</div>
</div>


<?php
global $user;
if ($user->uid == 0) {
	//print 'Login to view product.';
	//return false;
}

/*
$query = new EntityFieldQuery();

$query->entityCondition('entity_type', 'node')
->entityCondition('bundle', 'customers')
->propertyCondition('status', 1)
->fieldCondition('field_in_contact_number', 'value', $search_phone. '%', 'like')
->propertyCondition('title', $search_name. '%', 'like')
->range(0, 10)
->addMetaData('account', user_load(1)); // Run the query as user 1.

$result = $query->execute();
*/


$sql = '
	SELECT DISTINCT n.nid 
	FROM {node} n   
	LEFT JOIN {field_data_field_in_contact_number} ct
	ON n.nid = ct.entity_id
	WHERE (n.type = :type AND n.status = :status)
';

$params = array(':type'  => 'customers', ':status' => 1);

if ($search_name != '' AND $search_phone != '') {
	$sql .= 'AND (n.title LIKE :title AND ct.field_in_contact_number_value LIKE :phone)';
	$params[':title'] = '%'.$search_name.'%';
	$params[':phone'] = '%'.$search_phone.'%';

}
else if($search_name != '') {
	$sql .= 'AND (n.title LIKE :title)';
	$params[':title'] = '%'.$search_name.'%';

}
else if($search_phone != ''){
	$sql .= 'AND (ct.field_in_contact_number_value LIKE :phone)';
	$params[':phone'] = '%'.$search_phone.'%';
}


$result = db_query($sql, $params);

$nids = array();
foreach ($result as $record) {
	$nids[] = $record->nid;
}



$nodes = node_load_multiple($nids);

//pagger
$per_page = 2;
$current_page = pager_default_initialize(count($nodes), $per_page);
// Todo เปลี่ยนใน load เฉพาะเท่าที่แสดงแต่ละหน้า ไม่ใช่โหลดทั้งหมดทุกๆที
$chunks = array_chunk($nodes, $per_page, TRUE);

$total_node = count($nodes);
$run_num = 1;
foreach ($chunks[$current_page] as $node) {
	
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

print theme('pager', array('quantity', count($nodes)));

