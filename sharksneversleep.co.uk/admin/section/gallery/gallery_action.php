<?php
// CFCs
require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;

$_POST['gallery_name'] = addslashes($_POST['gallery_name']);
$_POST['gallery_description'] = addslashes($_POST['gallery_description']);

if($_GET['mode']=='add'){

	// get data
	$where = "";
	$dbobject->sql_orderby = 'display_order ASC';
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
header("Location: " .$site_url ."/section/gallery/index.php?action=" .$_GET['mode']);
?>