<?php 
$_GET['category_id']=$_GET['item_remove'];
	
$fieldarray = $dbobject->deleteRecord($_GET);
$errors = $dbobject->getErrors();

// get data
$where = "";
$qnav = $dbobject->getData($where);

$count=0;
foreach ($qnav as $row) {
	
	$count++;
	
	$_GLOBALS['category_id'] = $row['category_id'];
	$_GLOBALS['display_order'] = $count;
			
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	
}

$_GLOBALS['action']='delete';
?>