<?php 
// CFCs
require_once ROOT .'/cfc/adminAccess.php';
$dbadminaccessobj = new adminAccessObj;

if($_GET['mode']=='add'){
	
	// insert to db
	$fieldarray = $dbadminaccessobj->insertRecord($_POST);
	$errors = $dbadminaccessobj->getErrors();
	
	// get data
	$where = "";
	$qaccess = $dbadminaccessobj->getData($where);
	$recordcount=$dbadminaccessobj->numrows;
	
	$_GLOBALS["admin_access_type_id"]=$qaccess[$recordcount-1]["admin_access_type_id"];
	
}else if($_REQUEST['mode']=='edit'){

	$fieldarray = $dbadminaccessobj->updateRecord($_POST);
	$errors = $dbadminaccessobj->getErrors();
	
	$_GLOBALS["admin_access_type_id"]=$_GET["admin_access_type_id"];

}

// select exisiting entries in accessXrefNavigation table
require_once ROOT .'/cfc/accessXrefNavigation.php';
$dbccessxrefnavigationobj = new accessxrefnavigationObj;

// get data
$where = "admin_access_type_id='" .$_GLOBALS["admin_access_type_id"] ."'";
$qadminaccess = $dbccessxrefnavigationobj->getData($where);

// Clear any exisiting entries in accessXrefNavigation table
foreach ($qadminaccess as $row) {
  $_GLOBALS["xref_id"]=$row["xref_id"];	
  $fieldarray = $dbccessxrefnavigationobj->deleteRecord($_GLOBALS);
  $errors = $dbccessxrefnavigationobj->getErrors();
}

unset($_GLOBALS["xref_id"]);

// get adminnavigation data
// get content extended class
require_once ROOT .'/cfc/adminNavigation.php';
$dbobject = new adminNavigationObj;
$dbobject->sql_orderby = 'display_order';
$where = "";
$qadmin_nav = $dbobject->getData($where);

foreach ($qadmin_nav as $row) {
	
	
	
	if(isset($_POST['admin_nav_id_' .$row['admin_nav_id']]) && $_POST['admin_nav_id_' .$row['admin_nav_id']]!=''){
		
		$dbobject = new accessxrefnavigationObj;
		
		// insert into accessxrefnavigation
		$_GLOBALS["admin_nav_id"]=$row["admin_nav_id"];	
		$fieldarray = $dbobject->insertRecord($_GLOBALS);
		$errors = $dbobject->getErrors();
		
	}
}


// Insert new entries into accessXrefNavigation table



// relocate
header("Location: " .$site_url ."/section/website/admin_access.php?action=" .$_GET['mode']);
?>