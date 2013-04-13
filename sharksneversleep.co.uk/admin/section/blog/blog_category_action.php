<?php
// CFCs
require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;

$_POST['category'] = addslashes($_POST['category']);
$_POST['category_description'] = addslashes($_POST['category_description']);

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

require_once ROOT .'/admin/urlrewrite/rewrite.php';

// relocate
header("Location: " .$site_url ."/section/blog/blog_category.php?action=" .$_GET['mode']);
?>