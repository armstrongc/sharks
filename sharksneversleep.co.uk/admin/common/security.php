<?php
// param admin session
if(!isset($_SESSION['admin_logged_in']))$_SESSION['admin_logged_in']=0;

// check if logged in
if($secondaryDir != 'login' && $tertiaryDir != 'login'){

	if(!$_SESSION['admin_logged_in']){
		header("Location: " .$site_url ."/login/");
	}
}

// SUPER USER ACCESS FOR WEBSITE SETTINGS
if($tertiaryDir=="website" && $_SESSION['admin_access_type_id']>1){
	header("Location: " .$site_url ."/");
}

// SUPER USER & ADMINISTRATOR ACCESS FOR USER SETTINGS
if($tertiaryDir=="user" && $_SESSION['admin_access_type_id']>2){
	header("Location: " .$site_url ."/");
}

// CHECK THE DIRECTORY IS FINE FOR CONDITIONAL USERS
if(isset($_SESSION['admin_access_type_id']) && $_SESSION['admin_access_type_id']>3){
	
	if(!in_array($tertiaryDir, $_SESSION['admin_access_directory_list']) && $tertiaryDir != ''){
		header("Location: " .$site_url ."/");
	}

}
?>