<?php
// CFCs
require_once ROOT .'/cfc/galleryImage.php';
$dbobject = new galleryImageObj;

$_POST['image_file'] = addslashes($_POST['image_file']);
$_POST['image_file_original'] = addslashes($_POST['image_file_original']);
$_POST['image_name'] = addslashes($_POST['image_name']);
$_POST['image_description'] = addslashes($_POST['image_description']);

if($_GET['mode']=='add'){

	// get data
	$where = "gallery_id=" .$_POST['gallery_id'];
	$dbobject->sql_orderby = 'display_order ASC';
	$qnav = $dbobject->getData($where);

	// set display order
	$_POST['display_order']=$dbobject->numrows + 1;

	// insert to db
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();


	require_once ROOT .'/cfc/galleryImage.php';
	$dbobject = new galleryImageObj;
	$dbobject->sql_orderby = 'display_order';
	$where = "gallery_id=" .$_POST['gallery_id'];
	$qcheck = $dbobject->getData($where);
	$recordcount=$dbobject->numrows;

	$_GLOBALS['gallery_image_id'] = $qcheck[$recordcount-1]['gallery_image_id'];

}else if($_GET['mode']=='edit'){

	$fieldarray = $dbobject->updateRecord($_POST);
	$errors = $dbobject->getErrors();

	$_GLOBALS['gallery_image_id'] = $_POST['gallery_image_id'];
}




// relocate
header("Location: " .$site_url ."/section/gallery/gallery_image_crop.php?gallery_image_id=" .$_GLOBALS['gallery_image_id'] ."&gallery_id=" .$_GET['gallery_id'] ."&action=" .$_GET['mode']);
//header("Location: " .$site_url ."/section/gallery/gallery_image.php?gallery_id=" .$_GET['gallery_id'] ."&action=" .$_GET['mode']);
?>