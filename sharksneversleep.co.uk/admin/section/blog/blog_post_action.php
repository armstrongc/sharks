<?php
// CFCs
require_once ROOT .'/cfc/blogpost.php';
$dbobject = new blogpostObj;

// reformat date
$date = explode('-', $_POST['post_date']);
$_POST['post_date'] = $date[0] .'-' .$date[1] .'-' .$date[2];

$_POST['post_title'] = addslashes($_POST['post_title']);
$_POST['post_copy'] = addslashes($_POST['post_copy']);
$_POST['post_keywords'] = addslashes($_POST['post_keywords']);
$_POST['post_description'] = addslashes($_POST['post_description']);

if($_GET['mode']=='add'){

	// insert to db
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();

}else if($_GET['mode']=='edit'){

	$fieldarray = $dbobject->updateRecord($_POST);
	$errors = $dbobject->getErrors();
}

require_once ROOT .'/admin/urlrewrite/rewrite.php';

// relocate
header("Location: " .$site_url ."/section/blog/index.php?action=" .$_GET['mode']);
?>