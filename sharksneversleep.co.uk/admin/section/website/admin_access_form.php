<?php 
require_once '../../common/config.php';

$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['admin_access_type_id'])) $_GET['admin_access_type_id'] = '0';

// form params
if(!isset($_POST['admin_access_type'])) $_POST['admin_access_type'] = '';

// error params
if(!isset($_GLOBALS['admin_access_type.error'])) $_GLOBALS['admin_access_type.error'] = false;
if(!isset($_GLOBALS['admin_nav_id.error'])) $_GLOBALS['admin_nav_id.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("admin_access_validation.php");
	if($success)include("admin_access_action.php");
}

// delete from accessxrefnavigation
require_once ROOT .'/cfc/accessXrefNavigation.php';
$dbccessxrefnavigationobj = new accessxrefnavigationObj;

// get admin navigation xref access type data
$where = "admin_access_type_id='" .$_GET["admin_access_type_id"] ."'";
$qadminaccess = $dbccessxrefnavigationobj->getData($where);

$xreflist = array();
$x=0;
// Clear any exisiting entries in accessXrefNavigation table
foreach ($qadminaccess as $row) {
  $xreflist[$x] = $row['admin_nav_id'];
  $x=$x+1;
}

// get content extended class
require_once ROOT .'/cfc/adminNavigation.php';
$dbobject = new adminNavigationObj;
$dbobject->sql_orderby = 'display_order';

// get data
$where = "";
$qadmin_nav = $dbobject->getData($where);
$recordcount=$dbobject->numrows;
// 
if($_GET['mode']=="edit" && $load_defaults){
	
	// CFCs
	require_once ROOT .'/cfc/adminAccess.php';
	$dbobject = new adminAccessObj;
	
	// get data
	$where = "admin_access_type_id=" .$_GET['admin_access_type_id'];
	$qaccess = $dbobject->getData($where);
	
	foreach ($qaccess as $row) {
		$_POST['admin_access_type'] = $row['admin_access_type'];
	}
}

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/admin_access.php">Admin Access</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>

<h1>Admin Access Types - <?php echo $_GET['mode']?> an access type</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the access type below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="admin_access_form" id="admin_access_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?admin_access_type_id=<?php echo $_GET['admin_access_type_id']?>&mode=<?php echo $_GET['mode']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="admin_access_type_id" value="<?php echo $_GET['admin_access_type_id'] ?>" />
    
	<div class="control-group<?php if($_REQUEST['admin_access_type.error']){?> form_error<?php }?>">
      <label for="admin_access_type" class="mandatory">Access type name:</label>
      <div class="controls">
        <input type="Text" name="admin_access_type" id="admin_access_type" class="textinput" value="<?php echo $_POST['admin_access_type']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_REQUEST['admin_nav_id.error']){?> form_error<?php }?>">
      <div class="controls">
		<?php foreach ($qadmin_nav as $row) { ?>
        <label class="checkboxlabel"><?php echo $row['nav_item']?> <input type="Checkbox" name="admin_nav_id_<?php echo $row['admin_nav_id']?>" id="admin_nav_id_<?php echo $row['admin_nav_id']?>" class="checkboxinput" value="1" <?php if(in_array($row['admin_nav_id'], $xreflist)){ ?>checked="checked"<?php } ?> /></label>
        <?php }?>
      </div>
	</div>
	
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    
    </fieldset>
    
</form>

<?php require_once '../../common/footer.php'; ?>
