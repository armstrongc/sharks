<?php 
$_GLOBALS['content_id']=$_GET['item_remove'];
	
$fieldarray = $dbobject->deleteRecord($_GLOBALS);
$errors = $dbobject->getErrors();

// get data
$where = "";
$qcontent = $dbobject->getData($where);

$count=0;
foreach ($qcontent as $row) {
	
	$count++;
	
	$_GLOBALS['content_id'] = $row['content_id'];
	$_GLOBALS['display_order'] = $count;
			
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
}

$_GLOBALS['action']='delete';
?>