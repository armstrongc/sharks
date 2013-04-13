<?php

// get content extended class
require_once ROOT .'/cfc/user.php';
$dbobject = new userObj;

$dbobject->sql_where   = 'email="' .$_POST["username"] .'" AND password="' .$_POST["password"] .'"';

// get data
$where = "";
$qlogin = $dbobject->getData($where);

foreach ($qlogin as $row) {
  session_start();
  $_SESSION['user_id']=$row['user_id'];
  $_SESSION['user_email']=$row['email'];
  $_SESSION['user_first_name']=$row['first_name'];
  $_SESSION['user_last_name']=$row['last_name'];
  $_SESSION['user_display_name']=$row['display_name'];
  $_SESSION['admin_access_type_id']=$row['admin_access_type_id'];
  $_SESSION['admin_logged_in']=1;
}

// CREATE ADMIN ACCESS NAVIGATION ARRAY
require_once ROOT .'/cfc/accessXrefNavigation.php';
$dbccessxrefnavigationobj = new accessxrefnavigationObj;
$dbccessxrefnavigationobj->sql_from    = 'accessxrefnavigation axn INNER JOIN tbladminnavigation an ON axn.admin_nav_id = an.admin_nav_id';
$where = "admin_access_type_id='" .$_SESSION["admin_access_type_id"] ."'";
$qadminaccess = $dbccessxrefnavigationobj->getData($where);

$_SESSION['admin_access_list'] = array();
$_SESSION['admin_access_directory_list'] = array();
$x=0;
foreach ($qadminaccess as $row) {
  $_SESSION['admin_access_list'][$x] = $row['admin_nav_id'];
  $_SESSION['admin_access_directory_list'][$x] = $row['directory'];
  $x=$x+1;
}
$_SESSION['admin_access_directory_list'][$x]='user_details'; $x=$x+1;

header("Location: " .$site_url ."/");
?>


