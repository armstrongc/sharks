<?php 
$success = 1;
$errMsg = '';

if(!strLen($_POST["display_name"])){
	$success = 0;
	$_GLOBALS["display_name.error"] = true;
}

if(strLen($_POST["new_password"])){
	
	if($_POST["new_password"]!=$_POST["confirm_password"]){
		$success = 0;
		$_GLOBALS["new_password.error"] = true;	
		$_GLOBALS["confirm_password.error"] = true;	
	}
	
	// CFCs
	require_once ROOT .'/cfc/user.php';
	$dbobject = new userObj;
		
	// get data
	$where = 'user_id="' .$_SESSION['user_id'] .'"';
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$currentpassword = $row['password'];
	}
	
	if($_POST["password"]!=$currentpassword){
		$success = 0;
		$_GLOBALS["password.error"] = true;	
	}
	
}

if(!$success) $errMsg = 'Please amend the following fields - <br />' .$errMsg ;
?>