<?php
// validate name
if ($_REQUEST['name'] == "") { 
	$success = false; 
	$_REQUEST['name.error'] = true;
}

// validate email
if ($_REQUEST['email'] == "") { 
	$success = false; 
	$_REQUEST['email.error'] = true;
	
} else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_REQUEST['email'])) {
    $success = false; 
	$_REQUEST['email.error'] = true;
}

// validate messgae
if ($_REQUEST['message'] == "") { 
	$success = false; 
	$_REQUEST['message.error'] = true;
}

if (!$success) {
	$msg = "please correct the errors below";
}
?>
