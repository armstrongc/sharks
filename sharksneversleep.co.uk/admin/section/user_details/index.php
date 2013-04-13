<?php
// GET CONFIG
require_once '../../common/config.php';

$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['user_id'])) $_GET['user_id'] = '0';

// form params
if(!isset($_POST['display_name'])) $_POST['display_name'] = '';
if(!isset($_POST['new_password'])) $_POST['new_password'] = '';
if(!isset($_POST['confirm_password'])) $_POST['confirm_password'] = '';
if(!isset($_POST['password'])) $_POST['password'] = '';

// error params
if(!isset($_GLOBALS['display_name.error'])) $_GLOBALS['display_name.error'] = false;
if(!isset($_GLOBALS['new_password.error'])) $_GLOBALS['new_password.error'] = false;
if(!isset($_GLOBALS['confirm_password.error'])) $_GLOBALS['confirm_password.error'] = false;
if(!isset($_GLOBALS['password.error'])) $_GLOBALS['password.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("user_details_validation.php");
	if($success)include("user_details_action.php");
}

// get default values
if($load_defaults){
	// CFCs
	require_once ROOT .'/cfc/user.php';
	$dbobject = new userObj;
		
	// get data
	$where = 'user_id="' .$_SESSION['user_id'] .'"';
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$_POST['display_name'] = $row['display_name'];
	}
}

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">My Details</li>
</ul>

<h1>My Details</h1>
<div class="alert alert-info">Edit your details below.</div>
<?php if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Details updated successfully.
    </div>
<?php }?>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="user_form" id="user_form" class="admin_form" action="index.php" method="post">
	
    <fieldset>
    
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
    <input type="hidden" name="first_name" id="first_name" value="<?php echo $_SESSION['user_first_name']; ?>" />
    <input type="hidden" name="last_name" id="last_name" value="<?php echo $_SESSION['user_last_name']; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['user_email']; ?>" />
	
    <div class="control-group<?php if($_GLOBALS['display_name.error']){?> form_error<?php }?>">
      <label for="display_name" class="mandatory">Display Name:</label>
      <div class="controls">
        <input type="text" name="display_name" id="display_name" class="textinput" value="<?php echo $_POST['display_name']?>" required />
      </div>
	</div>
	
    <div class="control-group<?php if($_GLOBALS['new_password.error']){?> form_error<?php }?>">
      <label for="new_password" class="mandatory">Change Password:</label>
      <div class="controls">
        <input type="password" name="new_password" id="new_password" class="textinput" value="<?php echo $_POST['new_password']?>" />
      </div>
	</div>
    
    <div class="control-group<?php if($_GLOBALS['confirm_password.error']){?> form_error<?php }?>">
      <label for="new_password" class="mandatory">Confirm Changed Password:</label>
      <div class="controls">
        <input type="password" name="confirm_password" id="confirm_password" class="textinput" value="<?php echo $_POST['confirm_password']?>" />
      </div>
	</div>
    
    <div class="control-group<?php if($_GLOBALS['password.error']){?> form_error<?php }?>">
      <label for="password" class="mandatory">Current Password:</label>
      <div class="controls">
        <input type="password" name="password" id="password" class="textinput" value="<?php echo $_POST['password']?>" />
      </div>
	</div>
    
    <div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    
    </fieldset>
</form>

<?php require_once '../../common/footer.php'; ?>
