<?php 
$_GET['author_id']=$_GET['item_id'];
$_GET['is_live']=$_GET['item_live'];
if($_GET['is_live']=='0') $_GET['is_live']='';
	
$fieldarray = $dbobject->updateRecord($_GET);
$errors = $dbobject->getErrors();

$_GLOBALS['action']='live';

?>