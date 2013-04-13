<?php 
$success = 1;
$checksuccess = 0;
$errMsg = '';

if(!strLen($_POST["admin_access_type"])){
	$success = 0;
	$_GLOBALS["admin_access_type.error"] = true;
}

require_once ROOT .'/cfc/adminNavigation.php';
$dbobject = new adminNavigationObj;
$dbobject->sql_orderby = 'display_order';

// get data
$where = "";
$qadmin_nav = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

foreach ($qadmin_nav as $row) {
	if(isset($_POST['admin_nav_id_' .$row['admin_nav_id']])){
		$checksuccess = 1;
	}
}

if(!$checksuccess){
	$_GLOBALS["admin_nav_id.error"] = true;
	$success = 0;
}

if(!$success) $errMsg = 'Please amend the following fields - <br />' .$errMsg ;
?>