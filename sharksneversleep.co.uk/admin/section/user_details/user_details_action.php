<?php
// CFCs
require_once ROOT .'/cfc/user.php';
$dbobject = new userObj;

// get data
$where = 'user_id="' .$_SESSION['user_id'] .'"';
$quser = $dbobject->getData($where);

foreach ($quser as $row) {
	if(!isset($_POST['new_password']) || $_POST['new_password']==''){
		$_POST['password'] = $row['password'];
	}else{
		$_POST['password'] = $_POST['new_password'];
	}
	$_POST['admin_access_type_id'] = $row['admin_access_type_id'];
}

$_POST['display_name'] = addslashes($_POST['display_name']);
$_POST['new_password'] = addslashes($_POST['new_password']);
$_POST['confirm_password'] = addslashes($_POST['confirm_password']);
$_POST['password'] = addslashes($_POST['password']);

//CFCs
$dbobject = new userObj;

$fieldarray = $dbobject->updateRecord($_POST);
$errors = $dbobject->getErrors();

$_POST['new_password'] = '';
$_POST['confirm_password'] = '';
$_POST['password'] = '';
$_GLOBALS['action']='edit';
?>