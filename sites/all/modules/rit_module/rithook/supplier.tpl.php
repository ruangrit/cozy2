<?php

// search value

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
		<div class="col-xs-12 text-left">
		<form method="GET">
			<b>Search Supplier by:</b>
		
			
				Supplier/Coordinator Name: <input type="text" name="title" value="<?php print $search_name;?>">
				Supplier/Coordinator Contact number: <input type="text" name="phone" value="<?php print $search_phone; ?>">
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

$sql = '
	SELECT DISTINCT n.nid 
	FROM {node} n   
	LEFT JOIN {field_data_field_contact_number} ct
	ON n.nid = ct.entity_id
	WHERE (n.type = :type AND n.status = :status)
';

$params = array(':type'  => 'suppliers', ':status' => 1);

if ($search_name != '' AND $search_phone != '') {
	$sql .= 'AND (n.title LIKE :title AND ct.field_contact_number_value LIKE :phone)';
	$params[':title'] = '%'.$search_name.'%';
	$params[':phone'] = '%'.$search_phone.'%';

}
else if($search_name != '') {
	$sql .= 'AND (n.title LIKE :title)';
	$params[':title'] = '%'.$search_name.'%';

}
else if($search_phone != ''){
	$sql .= 'AND (ct.field_contact_number_value LIKE :phone)';
	$params[':phone'] = '%'.$search_phone.'%';
}

$sql .= ' ORDER BY n.nid DESC';

$result = db_query($sql, $params);

$nids = array();
foreach ($result as $record) {
	$nids[] = $record->nid;
}
if(count($nids) == 0) {
	print '-- No data ---';
}
else {
		
	//pagger
	$per_page = 4;
	$current_page = pager_default_initialize(count($nids), $per_page);
	$chunks = array_chunk($nids, $per_page, TRUE);
	$total_node = count($nids);

	// table 
	$header = array('No' ,'Supplier ID', 'Name', 'Email', 'Operations');
	$rows = array();

	$nodes = node_load_multiple($chunks[$current_page]);
	$run_num = 0;
	foreach ($nodes as $node) {
		
		$email = rit_hook_display_multiple_comma($node->field_email['und']);
		$rows[] = array(
			($current_page * $per_page) + $run_num + 1,
			$node->field_supplier_code['und'][0]['value'],
			$node->title,
			$email,
			l('View', 'node/'.$node->nid) .' '. l('Edit', 'node/'.$node->nid.'/edit'),
			);
		$run_num++;
	}

	print theme('table', array('header' => $header, 'rows' => $rows));
	print theme('pager', array('quantity', count($nodes)));



}


