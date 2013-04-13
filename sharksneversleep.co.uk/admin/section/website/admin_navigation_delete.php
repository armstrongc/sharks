<?php 
$_GET['admin_nav_id']=$_GET['item_remove'];
	
$fieldarray = $dbobject->deleteRecord($_GET);
$errors = $dbobject->getErrors();

// get data
$where = "";
$qnav = $dbobject->getData($where);

$count=0;
foreach ($qnav as $row) {
	
	$count++;
	
	$_GLOBALS['admin_nav_id'] = $row['admin_nav_id'];
	$_GLOBALS['display_order'] = $count;
			
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	
}

$_GLOBALS['action']='delete';
?>