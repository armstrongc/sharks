<?php
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['category_id'])) $_GET['category_id'] = '0';

// form params
if(!isset($_POST['category'])) $_POST['category'] = '';
if(!isset($_POST['image_file'])) $_POST['image_file'] = '';
if(!isset($_POST['image_file_original'])) $_POST['image_file_original'] = '';
if(!isset($_POST['category_description'])) $_POST['category_description'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';

// error params
if(!isset($_GLOBALS['category.error'])) $_GLOBALS['category.error'] = false;
if(!isset($_GLOBALS['image_file.error'])) $_GLOBALS['image_file.error'] = false;
if(!isset($_GLOBALS['category_description.error'])) $_GLOBALS['category_description.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("blog_category_validation.php");
	if($success)include("blog_category_action.php");
}

// CFCs
require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "category_id=" .$_GET['category_id'];
	$quser = $dbobject->getData($where);

	foreach ($quser as $row) {
		$_POST['category'] = $row['category'];
    $_POST['image_file_original'] = $row['image_file'];
    $_POST['image_file'] = $row['image_file'];
    $_POST['category_description'] = $row['category_description'];
		$_POST['is_live'] = $row['is_live'];
	}
}

// header file
require_once '../../common/header.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/blog_category.php">Blog Categories</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>Blog Categories - <?php echo $_GET['mode']?> a category</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the category below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form enctype="multipart/form-data" name="blog_category_form" id="blog_category_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?category_id=<?php echo $_GET['category_id']?>&mode=<?php echo $_GET['mode']?>" method="post">

    <fieldset>

    <input type="hidden" name="category_id" value="<?php echo $_GET['category_id']?>" />
    <input type="hidden" name="image_file_original" value="<?php echo $_POST['image_file_original']?>" />

  	<div class="control-group<?php if($_GLOBALS['category.error']){?> form_error<?php }?>">
        <label for="category" class="mandatory">Category:</label>
        <div class="controls">
          <input type="Text" name="category" id="category" class="textinput" value="<?php echo $_POST['category']?>" required />
        </div>
  	</div>

    <div class="control-group<?php if($_GLOBALS['image_file.error']){?> form_error<?php }?>">
        <label for="image_file" class="mandatory">Upload Image:</label>
        <div class="controls">
          <input type="file" name="image_file" id="image_file" class="textinput" />
        </div>
    </div>

    <?php if($_REQUEST['mode']=="edit" && $_POST['image_file'] !=''){?>
    <div class="control-group">
    <img src="/images/category/main/<?php echo $_POST['image_file']?>" height="150px" />
    </div>
    <?php } ?>

    <div class="control-group<?php if($_GLOBALS['category_description.error']){?> form_error<?php }?>">
      <label for="category_description" class="mandatory">Description:</label>
      <div class="controls">
        <textarea class="input-xlarge no-editor" name="category_description" id="category_description" rows="10" required><?php echo $_POST['category_description']?></textarea>
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
