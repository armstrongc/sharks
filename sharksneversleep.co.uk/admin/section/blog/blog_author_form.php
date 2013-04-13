<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['author_id'])) $_GET['author_id'] = '0';

// form params
if(!isset($_POST['author_first_name'])) $_POST['author_first_name'] = '';
if(!isset($_POST['author_last_name'])) $_POST['author_last_name'] = '';
if(!isset($_POST['author_display_name'])) $_POST['author_display_name'] = '';
if(!isset($_POST['author_email'])) $_POST['author_email'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';

// error params
if(!isset($_GLOBALS['author_first_name.error'])) $_GLOBALS['author_first_name.error'] = false;
if(!isset($_GLOBALS['author_last_name.error'])) $_GLOBALS['author_last_name.error'] = false;
if(!isset($_GLOBALS['author_display_name.error'])) $_GLOBALS['author_display_name.error'] = false;
if(!isset($_GLOBALS['author_email.error'])) $_GLOBALS['author_email.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("blog_author_validation.php");
	if($success)include("blog_author_action.php");
}

// CFCs
require_once ROOT .'/cfc/blogauthor.php';
$dbobject = new blogauthorObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "author_id=" .$_GET['author_id'];
	$quser = $dbobject->getData($where);
	
	foreach ($quser as $row) {
		$_POST['author_first_name'] = $row['author_first_name'];
		$_POST['author_last_name'] = $row['author_last_name'];
		$_POST['author_display_name'] = $row['author_display_name'];
		$_POST['author_email'] = $row['author_email'];
		$_POST['is_live'] = $row['is_live'];
	}
}

// header file
require_once '../../common/header.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/blog_author.php">Blog Authors</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>Blog Authors - <?php echo $_GET['mode']?> an author</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the author below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="blog_author_form" id="blog_author_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?author_id=<?php echo $_GET['author_id']?>&mode=<?php echo $_GET['mode']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="author_id" value="<?php echo $_GET['author_id']?>" />
    
	<div class="control-group<?php if($_GLOBALS['author_first_name.error']){?> form_error<?php }?>">
      <label for="author_first_name" class="mandatory">First Name:</label>
      <div class="controls">
        <input type="Text" name="author_first_name" id="author_first_name" class="textinput" value="<?php echo $_POST['author_first_name']?>" required />
      </div>
	</div>
	
    <div class="control-group<?php if($_GLOBALS['author_last_name.error']){?> form_error<?php }?>">
      <label for="author_last_name" class="mandatory">Last Name:</label>
      <div class="controls">
        <input type="Text" name="author_last_name" id="author_last_name" class="textinput" value="<?php echo $_POST['author_last_name']?>" required />
      </div>
	</div>
    
    <div class="control-group<?php if($_GLOBALS['author_display_name.error']){?> form_error<?php }?>">
      <label for="author_display_name" class="mandatory">Display Name:</label>
      <div class="controls">
        <input type="Text" name="author_display_name" id="author_display_name" class="textinput" value="<?php echo $_POST['author_display_name']?>" required />
      </div>
	</div>
    
    <div class="control-group<?php if($_GLOBALS['author_email.error']){?> form_error<?php }?>">
      <label for="author_email" class="mandatory">Email:</label>
      <div class="controls">
        <input type="email" name="author_email" id="author_email" class="textinput" value="<?php echo $_POST['author_email']?>" required />
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
