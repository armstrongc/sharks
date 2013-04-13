<?php
// CFCs
require_once ROOT .'/cfc/blogauthor.php';
$dbobject = new blogauthorObj;

$_POST['author_first_name'] = addslashes($_POST['author_first_name']);
$_POST['author_last_name'] = addslashes($_POST['author_last_name']);
$_POST['author_display_name'] = addslashes($_POST['author_display_name']);
$_POST['author_email'] = addslashes($_POST['author_email']);

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
header("Location: " .$site_url ."/section/blog/blog_author.php?action=" .$_GET['mode']);
?>