<?php 
$success = 1;
$errMsg = '';

if(!strLen($_POST["first_name"])){
	$success = 0;
	$_GLOBALS["first_name.error"] = true;
}

if(!strLen($_POST["last_name"])){
	$success = 0;
	$_GLOBALS["last_name.error"] = true;
}

if(!strLen($_POST["display_name"])){
	$success = 0;
	$_GLOBALS["display_name.error"] = true;
}

if(!strLen($_POST["email"])){
	$success = 0;
	$_GLOBALS["email.error"] = true;
}

if(!strLen($_POST["password"])){
	$success = 0;
	$_GLOBALS["password.error"] = true;
}

if($_POST["admin_access_type_id"] == '' ){
	$success = 0;
	$_GLOBALS["admin_access_type_id.error"] = true;
}

if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>