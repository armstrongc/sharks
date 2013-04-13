<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['gallery_id'])) $_GET['gallery_id'] = '0';

// form params
if(!isset($_POST['gallery_name'])) $_POST['gallery_name'] = '';
if(!isset($_POST['gallery_description'])) $_POST['gallery_description'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';
if(!isset($_POST['display_order'])) $_POST['display_order'] = '';

// error params
if(!isset($_GLOBALS['gallery_name.error'])) $_GLOBALS['gallery_name.error'] = false;
if(!isset($_GLOBALS['gallery_description.error'])) $_GLOBALS['gallery_description.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;
if(!isset($_GLOBALS['display_order.error'])) $_GLOBALS['display_order.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("gallery_validation.php");
	if($success)include("gallery_action.php");
}

// CFCs
require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "gallery_id=" .$_GET['gallery_id'];
	$dbobject->sql_orderby = 'display_order ASC';
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$_POST['gallery_name'] = $row['gallery_name'];
		$_POST['gallery_description'] = $row['gallery_description'];
		$_POST['is_live'] = $row['is_live'];
		$_POST['display_order'] = $row['display_order'];
	}
}

// header file
require_once '../../common/header.php';
// CMS editor
require_once '../../../includes/editor.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/gallery/">Gallery</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>Gallery - <?php echo $_GET['mode']?> a gallery</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the gallery below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="gallery_form" id="gallery_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?gallery_id=<?php echo $_GET['gallery_id']?>&mode=<?php echo $_GET['mode']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="gallery_id" value="<?php echo $_GET['gallery_id']?>" />

    <div class="control-group<?php if($_GLOBALS['gallery_name.error']){?> form_error<?php }?>">
      <label for="gallery_name" class="mandatory">Name:</label>
      <div class="controls">
        <input type="Text" name="gallery_name" id="gallery_name" class="textinput" value="<?php echo $_POST['gallery_name']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['gallery_description.error']){?> form_error<?php }?>">
      <label for="gallery_description" class="mandatory">Description:</label>
      <div class="controls">
        <textarea class="input-xlarge" name="gallery_description" id="gallery_description" rows="10"><?php echo $_POST['gallery_description']?></textarea>
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
