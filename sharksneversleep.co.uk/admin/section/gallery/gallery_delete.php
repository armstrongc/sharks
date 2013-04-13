<?php 
$_GET['gallery_id']=$_GET['item_remove'];
	
$fieldarray = $dbobject->deleteRecord($_GET);
$errors = $dbobject->getErrors();

// get data
$where = "";
$qnav = $dbobject->getData($where);

$count=0;
foreach ($qnav as $row) {
	
	$count++;
	
	$_GLOBALS['gallery_id'] = $row['gallery_id'];
	$_GLOBALS['display_order'] = $count;
			
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	
}


// delete gallery images
require_once ROOT .'/cfc/galleryimage.php';
$dbobject = new galleryImageObj;
$where = "gallery_id=" .$_GET['gallery_id'];
$qpost = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

foreach ($qpost as $row) {
	$_GET['item_remove'] = $row['gallery_image_id'];
	include 'gallery_image_delete.php';	
}

// CFCs
require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;

$_GLOBALS['action']='delete' .$recordcount;
?>