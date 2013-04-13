<?php $success = 1;
$errMsg = '';

if(!strLen($_POST["nav_item"])){
	$success = 0;
	$_GLOBALS["nav_item.error"] = true;
}

if(!strLen($_POST["directory"])){
	$success = 0;
	$_GLOBALS["directory.error"] = true;
}

if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
}

if(!$success) $errMsg = 'Please amend the following fields - <br />' .$errMsg ;
?>