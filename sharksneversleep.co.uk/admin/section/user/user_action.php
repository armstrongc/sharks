<?php
// CFCs
require_once ROOT .'/cfc/user.php';
require_once ROOT .'/cfc/userProfile.php';

$_POST['first_name'] = addslashes($_POST['first_name']);
$_POST['last_name'] = addslashes($_POST['last_name']);
$_POST['display_name'] = addslashes($_POST['display_name']);
$_POST['email'] = addslashes($_POST['email']);
$_POST['password'] = addslashes($_POST['password']);

if($_GET['mode']=='add'){

	$dbobject = new userObj;
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();

	$dbobject = new userProfileObj;
	$fieldarray = $dbobject->insertRecord($_POST);
	$errors = $dbobject->getErrors();

}else if($_GET['mode']=='edit'){

	$dbobject = new userObj;
	$fieldarray = $dbobject->updateRecord($_POST);
	$errors = $dbobject->getErrors();

	$dbobject = new userProfileObj;
	$where = "user_id='" .$_GET['user_id'] ."'";
	$dbobject = $dbobject->getData($where);

	if(!$dbobject){
		$dbobject = new userProfileObj;
		$fieldarray = $dbobject->insertRecord($_POST);
		$errors = $dbobject->getErrors();
	}
}

// relocate
header("Location: " .$site_url ."/section/user/index.php?action=" .$_GET['mode']);
?>