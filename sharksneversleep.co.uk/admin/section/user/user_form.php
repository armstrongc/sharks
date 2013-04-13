<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['user_id'])) $_GET['user_id'] = '0';

// form params
if(!isset($_POST['first_name'])) $_POST['first_name'] = '';
if(!isset($_POST['last_name'])) $_POST['last_name'] = '';
if(!isset($_POST['display_name'])) $_POST['display_name'] = '';
if(!isset($_POST['email'])) $_POST['email'] = '';
if(!isset($_POST['password'])) $_POST['password'] = '';
if(!isset($_POST['admin_access_type_id'])) $_POST['admin_access_type_id'] = '';

// error params
if(!isset($_GLOBALS['first_name.error'])) $_GLOBALS['first_name.error'] = false;
if(!isset($_GLOBALS['last_name.error'])) $_GLOBALS['last_name.error'] = false;
if(!isset($_GLOBALS['display_name.error'])) $_GLOBALS['display_name.error'] = false;
if(!isset($_GLOBALS['email.error'])) $_GLOBALS['email.error'] = false;
if(!isset($_GLOBALS['password.error'])) $_GLOBALS['password.error'] = false;
if(!isset($_GLOBALS['admin_access_type_id.error'])) $_GLOBALS['admin_access_type_id.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("user_validation.php");
	if($success)include("user_action.php");
}

// CFCs
require_once ROOT .'/cfc/user.php';
$dbobject = new userObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "user_id=" .$_GET['user_id'];
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$_POST['first_name'] = $row['first_name'];
		$_POST['last_name'] = $row['last_name'];
		$_POST['display_name'] = $row['display_name'];
		$_POST['email'] = $row['email'];
		$_POST['password'] = $row['password'];
		$_POST['admin_access_type_id'] = $row['admin_access_type_id'];
	}
}

require_once ROOT .'/cfc/adminAccess.php';
$dbobject = new adminAccessObj;

// get data
$where = '';
$qadminaccess = $dbobject->getData($where);

// header file
require_once '../../common/header.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/user/">Users</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>User Management - <?php echo $_GET['mode']?> a User</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the Admin User below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="user_form" id="user_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?user_id=<?php echo $_GET['user_id']?>&mode=<?php echo $_GET['mode']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']?>" />
    
	<div class="control-group<?php if($_GLOBALS['first_name.error']){?> form_error<?php }?>">
      <label for="first_name" class="mandatory">First Name:</label>
      <div class="controls">
        <input type="Text" name="first_name" id="first_name" class="textinput" value="<?php echo $_POST['first_name']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['last_name.error']){?> form_error<?php }?>">
      <label for="last_name" class="mandatory">Last Name:</label>
      <div class="controls">
        <input type="Text" name="last_name" id="last_name" class="textinput" value="<?php echo $_POST['last_name']?>" required />
      </div>
	</div>
	
    <div class="control-group<?php if($_GLOBALS['display_name.error']){?> form_error<?php }?>">
      <label for="display_name" class="mandatory">Display Name:</label>
      <div class="controls">
        <input type="Text" name="display_name" id="display_name" class="textinput" value="<?php echo $_POST['display_name']?>" required />
      </div>
	</div>
    
	<div class="control-group<?php if($_GLOBALS['email.error']){?> form_error<?php }?>">
      <label for="email" class="mandatory">Email Address:</label>
      <div class="controls">
        <input type="email" name="email" id="email" class="textinput" value="<?php echo $_POST['email']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['password.error']){?> form_error<?php }?>">
      <label for="password" class="mandatory">Password:</label>
      <div class="controls">
        <input type="text" name="password" id="password" class="textinput" value="<?php echo $_POST['password']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['admin_access_type_id.error']){?> form_error<?php }?>">
      <label for="admin_access_type_id" class="mandatory">Access type:</label>
      <div class="controls">
        <select name="admin_access_type_id" id="admin_access_type_id" class="selectinput" required>
            <option value="">select access type</option>
            <?php foreach ($qadminaccess as $row) {?>
                <option value="<?php echo $row['admin_access_type_id']?>"<?php if($_POST['admin_access_type_id']==$row['admin_access_type_id']){?> selected="selected"<?php }?>><?php echo $row['admin_access_type']?></option>
            <?php }?>
        </select>
      </div>
	</div>
	
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    
    </fieldset>
    
</form>

<?php require_once '../../common/footer.php'; ?>
