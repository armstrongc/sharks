<?php 
$_GET['admin_access_type_id']=$_GET['item_remove'];
	
// delete from tbladminaccesstype
$fieldarray = $dbobject->deleteRecord($_GET);
$errors = $dbobject->getErrors();

// delete from accessxrefnavigation
require_once ROOT .'/cfc/accessXrefNavigation.php';
$dbccessxrefnavigationobj = new accessxrefnavigationObj;

// get data
$where = "admin_access_type_id='" .$_GET["admin_access_type_id"] ."'";
$qadminaccess = $dbccessxrefnavigationobj->getData($where);

// Clear any exisiting entries in accessXrefNavigation table
foreach ($qadminaccess as $row) {
  $_GLOBALS["xref_id"]=$row["xref_id"];	
  $fieldarray = $dbccessxrefnavigationobj->deleteRecord($_GLOBALS);
  $errors = $dbccessxrefnavigationobj->getErrors();
}

$_REQUEST['action']='delete';
?>