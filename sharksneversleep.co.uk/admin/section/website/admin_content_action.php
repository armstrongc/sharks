<?php 
// CFCs
require_once ROOT .'/cfc/content.php';
$dbobject = new contentObj;

if($_GET['mode']=='add'){
	
	// get data
	$where = "";
	$qcontent = $dbobject->getData($where);
	
	// set display order
	$_POST['display_order']=$dbobject->numrows + 1;
	
	// insert to db
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();
	
}else if($_REQUEST['mode']=='edit'){

	$fieldarray = $dbobject->updateRecord($_POST);
	$errors = $dbobject->getErrors();

}

// relocate
header("Location: " .$site_url ."/section/website/admin_content.php?action=" .$_GET['mode']);
?>