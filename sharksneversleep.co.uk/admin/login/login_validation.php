<?php 
$success = 1;
$errMsg = '';

if($_POST["username"]==''){
	$success = 0;
	$errMsg = $errMsg .'username<br />';
}

if($_POST["password"]==''){
	$success = 0;
	$errMsg = $errMsg .'password<br />';
}

if($errMsg!='') $errMsg = 'Please amend the following fields - <br />' .$errMsg ;
?>
