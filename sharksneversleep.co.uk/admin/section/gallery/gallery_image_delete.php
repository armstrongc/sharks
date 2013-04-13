<?php
// CFCs
require_once ROOT .'/cfc/galleryImage.php';
$dbobject = new galleryImageObj;
// get data
$where = "gallery_image_id=" .$_GET['item_remove'];
$dbobject->sql_orderby = 'display_order ASC';
$qdelete = $dbobject->getData($where);

$filename = $qdelete[0]['image_file'];

unlink(ROOT .'/images/gallery/' .$filename);
unlink(ROOT .'/images/gallery/main/' .$filename);
unlink(ROOT .'/images/gallery/thumbs/' .$filename);
unlink(ROOT .'/images/gallery/original/' .$filename);

$_GLOBALS['gallery_image_id']=$_GET['item_remove'];
$fieldarray = $dbobject->deleteRecord($_GLOBALS);
$errors = $dbobject->getErrors();

// get data
$where = "gallery_id=" .$_GET['gallery_id'];
$qnav = $dbobject->getData($where);

$count=0;
foreach ($qnav as $row) {
	
	$count++;
	
	$_GLOBALS['gallery_image_id'] = $row['gallery_image_id'];
	$_GLOBALS['display_order'] = $count;
			
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	
}

$_GLOBALS['action']='delete';
?>