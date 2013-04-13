<?php 
$success = 1;
$errMsg = '';

if(!strLen($_POST["page_title"])){
	$success = 0;
	$_GLOBALS["page_title.error"] = true;
}

if(!strLen($_POST["filename"])){
	$success = 0;
	$_GLOBALS["filename.error"] = true;
}

if(!strLen($_POST["directory"])){
	$success = 0;
	$_GLOBALS["directory.error"] = true;
}


if(!$success) $errMsg = 'Please amend the following fields - <br />' .$errMsg ;
?>
