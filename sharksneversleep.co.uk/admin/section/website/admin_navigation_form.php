<?php 
require_once '../../common/config.php';

$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['admin_nav_id'])) $_GET['admin_nav_id'] = '0';

// form params
if(!isset($_POST['nav_item'])) $_POST['nav_item'] = '';
if(!isset($_POST['directory'])) $_POST['directory'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';

// error params
if(!isset($_GLOBALS['nav_item.error'])) $_GLOBALS['nav_item.error'] = false;
if(!isset($_GLOBALS['directory.error'])) $_GLOBALS['directory.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("admin_navigation_validation.php");
	if($success)include("admin_navigation_action.php");
}

// 
if($_GET['mode']=="edit" && $load_defaults){
	
	// get content extended class
	require_once ROOT .'/cfc/adminNavigation.php';
	$dbobject = new adminnavigationObj;
	
	// get data
	$where = "admin_nav_id=" .$_GET['admin_nav_id'];
	$qnav = $dbobject->getData($where);
	
	foreach ($qnav as $row) {
		$_POST['nav_item'] = $row['nav_item'];
		$_POST['directory'] = $row['directory'];
		$_POST['is_live'] = $row['is_live'];
	}
	
}

// header file
require_once '../../common/header.php';
 ?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/admin_navigation.php">Admin Navigation</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode']; ?></li>
</ul>

<h1>Admin Navigation - <?php echo $_GET['mode']?> a Navigation item</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the content item below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="admin_navigation_form" id="admin_navigation_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?mode=<?php echo $_GET['mode']?>&admin_nav_id=<?php echo $_GET['admin_nav_id']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="admin_nav_id" value="<?php echo $_GET['admin_nav_id']?>" />
    
	<div class="control-group<?php if($_GLOBALS['nav_item.error']){?> form_error<?php }?>">
      <label for="nav_item" class="mandatory">Nav Item:</label>
      <div class="controls">
        <input type="Text" name="nav_item" id="nav_item" class="textinput" value="<?php echo $_POST['nav_item']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['directory.error']){?> form_error<?php }?>">
      <label for="directory" class="mandatory">Directory:</label>
      <div class="controls">
        <input type="Text" name="directory" id="directory" class="textinput" value="<?php echo $_POST['directory']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['is_live.error']){?> form_error<?php }?>">
      <label for="is_live" class="mandatory">Is Live:</label>
      <div class="controls">
        <input type="Checkbox" class="checkboxinput" name="is_live" id="is_live" value="1" <?php if($_POST['is_live']){?>checked="checked"<?php }?> />
      </div>
	</div>
	
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    
    </fieldset>
    
</form>

<?php require_once '../../common/footer.php'; ?>
