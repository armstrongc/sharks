<?php 
require_once '../common/config.php';

$_SESSION['user_id']='';
$_SESSION['user_email']='';
$_SESSION['user_first_name']='';
$_SESSION['user_last_name']='';
$_SESSION['admin_logged_in']=0;
header("Location: " .$site_url ."/login/");
?>