<?php 
$success = 1;
$errMsg = '';

if(!strLen($_POST["author_first_name"])){
	$success = 0;
	$_GLOBALS["author_first_name.error"] = true;
}

if(!strLen($_POST["author_last_name"])){
	$success = 0;
	$_GLOBALS["author_last_name.error"] = true;
}

if(!strLen($_POST["author_display_name"])){
	$success = 0;
	$_GLOBALS["author_display_name.error"] = true;
}

if(!strLen($_POST["author_email"])){
	$success = 0;
	$_GLOBALS["author_email.error"] = true;
}

if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
}

if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>