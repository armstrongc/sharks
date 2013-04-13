<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

if(!isset($_GET['gallery_id'])) $_GET['gallery_id'] = '0';

require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;
$where = "gallery_id=" .$_GET['gallery_id'];
$qpost = $dbobject->getData($where);

$_GLOBALS['gallery_name']=$qpost[0]['gallery_name'];

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['gallery_image_id'])) $_GET['gallery_image_id'] = '0';
if(!isset($_GET['gallery_id'])) $_GET['gallery_id'] = '0';

// form params
if(!isset($_POST['image_file'])) $_POST['image_file'] = '';
if(!isset($_POST['image_file_original'])) $_POST['image_file_original'] = '';
if(!isset($_POST['image_name'])) $_POST['image_name'] = '';
if(!isset($_POST['image_description'])) $_POST['image_description'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';
if(!isset($_POST['display_order'])) $_POST['display_order'] = '';

// error params
if(!isset($_GLOBALS['image_file.error'])) $_GLOBALS['image_file.error'] = false;
if(!isset($_GLOBALS['image_name.error'])) $_GLOBALS['image_name.error'] = false;
if(!isset($_GLOBALS['image_description.error'])) $_GLOBALS['image_description.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;
if(!isset($_GLOBALS['display_order.error'])) $_GLOBALS['display_order.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("gallery_image_validation.php");
	if($success)include("gallery_image_action.php");
}

// CFCs
require_once ROOT .'/cfc/galleryImage.php';
$dbobject = new galleryImageObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "gallery_image_id=" .$_GET['gallery_image_id'];
	$dbobject->sql_orderby = 'display_order ASC';
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$_POST['gallery_id'] = $row['gallery_id'];
		$_POST['image_file'] = $row['image_file'];
		$_POST['image_file_original'] = $row['image_file'];
		$_POST['image_name'] = $row['image_name'];
		$_POST['image_description'] = $row['image_description'];
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
  <li><a href="<?php echo $site_url ?>/section/gallery/gallery_image.php?gallery_id=<?php echo $_GET['gallery_id'] ?>"><?php echo $_GLOBALS['gallery_name'] ?></a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>

<h1>Gallery Images (<?php echo $_GLOBALS['gallery_name'] ?>) - <?php echo $_GET['mode']?> an image</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the image below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form enctype="multipart/form-data" name="gallery_image_form" id="gallery_image_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?gallery_id=<?php echo $_GET['gallery_id']?>&gallery_image_id=<?php echo $_GET['gallery_image_id']?>&mode=<?php echo $_GET['mode']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="gallery_image_id" value="<?php echo $_GET['gallery_image_id']?>" />
    <input type="hidden" name="gallery_id" value="<?php echo $_GET['gallery_id']?>" />
    <input type="hidden" name="image_file_original" value="<?php echo $_POST['image_file_original']?>" />
    <input type="hidden" name="display_order" value="<?php echo $_POST['display_order']?>" />
    
    <div class="control-group<?php if($_GLOBALS['image_file.error']){?> form_error<?php }?>">
      <label for="image_file" class="mandatory">Upload Image:</label>
      <div class="controls">
        <input type="file" name="image_file" id="image_file" class="textinput" />
      </div>
	</div>
    
    <?php if($_REQUEST['mode']=="edit"){?>
    <div class="control-group">
    <img src="/images/gallery/main/<?php echo $_POST['image_file']?>" height="150px" />
    </div>
    <?php } ?>
    
	<div class="control-group<?php if($_GLOBALS['image_name.error']){?> form_error<?php }?>">
      <label for="image_name" class="mandatory">Name:</label>
      <div class="controls">
        <input type="Text" name="image_name" id="image_name" class="textinput" value="<?php echo $_POST['image_name']?>" required />
      </div>
	</div>
    
    <div class="control-group<?php if($_GLOBALS['image_description.error']){?> form_error<?php }?>">
      <label for="image_description" class="mandatory">Description:</label>
      <div class="controls">
        <textarea class="input-xlarge" name="image_description" id="image_description" rows="10"><?php echo $_POST['image_description']?></textarea>
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

<script>
$(function() {
	$( "#comment_date" ).datepicker({ dateFormat: "dd/mm/yy" });
});
</script>