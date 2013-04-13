<?php
$success = 1;
$errMsg = '';

if(!strLen($_POST["comment_name"])){
	$success = 0;
	$_GLOBALS["comment_name.error"] = true;
}

/*
if(!strLen($_POST["comment_email"])){
	$success = 0;
	$_GLOBALS["comment_email.error"] = true;
}
*/

if(!strLen($_POST["comment_location"])){
	$success = 0;
	$_GLOBALS["comment_location.error"] = true;
}

if(!strLen($_POST["comment_copy"])){
	$success = 0;
	$_GLOBALS["comment_copy.error"] = true;
}

//$date = explode('-', $_POST['comment_date']);

// check if is valid date
/*
if(!strLen($_POST["comment_date"])){
	$success = 0;
	$_GLOBALS["comment_date.error"] = true;
} else if(!valid_date($date[2] .'-' .$date[1] .'-' .$date[0])){
	$success = 0;
	$_GLOBALS["comment_date.error"] = true;
}
*/
/*
if(!strLen($_POST["comment_date"])){
	$success = 0;
	$_GLOBALS["comment_date.error"] = true;
	$errMsg .= "date";
} else if(!checkdate($date[1], $date[2], $date[0])){
	$success = 0;
	$_GLOBALS["comment_date.error"] = true;
	$errMsg .= "date format - M" .$date[1] ." D - " .$date[2] ." Y - " .$date[0];
}
*/

if(!isset($_POST["is_live"])){
	$_POST["is_live"] = '';
}

if(!$success) $errMsg = 'Please amend the highlighted fields below - <br />' .$errMsg ;
?>