<?php
// CFCs
require_once ROOT .'/cfc/blogcomment.php';
$dbobject = new blogcommentObj;

// reformat date
/*
$date = explode('-', $_POST['comment_date']);
$_POST['comment_date'] = $date[0] .'-' .$date[1] .'-' .$date[2];
*/

$_POST['comment_name'] = addslashes($_POST['comment_name']);
$_POST['comment_email'] = addslashes($_POST['comment_email']);
$_POST['comment_location'] = addslashes($_POST['comment_location']);
$_POST['comment_copy'] = addslashes($_POST['comment_copy']);

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
header("Location: " .$site_url ."/section/blog/blog_comment.php?post_id=" .$_GET['post_id'] ."&action=" .$_GET['mode']);
?>