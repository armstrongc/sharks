<?php
// CFCs
require_once ROOT .'/cfc/content.php';
$dbobject = new contentObj;

$_POST['content'] = addslashes($_POST['content']);

$fieldarray = $dbobject->updateRecord($_POST);
$errors = $dbobject->getErrors();

// relocate
header("Location: " .$site_url ."/section/content/index.php?action=" .$_GET['mode']);

?>