<?php 
// CFCs
require_once ROOT .'/cfc/adminNavigation.php';
$dbobject = new adminNavigationObj;

if($_GET['mode']=='add'){
	
	// get data
	$where = "";
	$qnav = $dbobject->getData($where);
	
	// set display order
	$_POST['display_order']=$dbobject->numrows + 1;
	
	// insert to db
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();
	
}else if($_GET['mode']=='edit'){

	$fieldarray = $dbobject->updateRecord($_POST);
	$errors = $dbobject->getErrors();
}

// relocate
header("Location: " .$site_url ."/section/website/admin_navigation.php?action=" .$_GET['mode']);
?>