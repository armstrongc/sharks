<?php 
$success = 1;
$errMsg = '';

if(!strLen($_POST["gallery_name"])){
	$success = 0;
	$_GLOBALS["gallery_name.error"] = true;
}
/*
if(!strLen($_POST["gallery_description"])){
	$success = 0;
	$_GLOBALS["gallery_description.error"] = true;
}
*/
if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
}

if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>