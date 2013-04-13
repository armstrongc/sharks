<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['content_id'])) $_GET['content_id'] = '0';

// form params
if(!isset($_POST['page_title'])) $_POST['page_title'] = '';
if(!isset($_POST['filename'])) $_POST['filename'] = '';
if(!isset($_POST['directory'])) $_POST['directory'] = '';

// error params
if(!isset($_GLOBALS['page_title.error'])) $_GLOBALS['page_title.error'] = false;
if(!isset($_GLOBALS['filename.error'])) $_GLOBALS['filename.error'] = false;
if(!isset($_GLOBALS['directory.error'])) $_GLOBALS['directory.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("admin_content_validation.php");
	if($success)include("admin_content_action.php");
}

// 
if($_GET['mode']=="edit" && $load_defaults){
	
	// CFCs
	require_once ROOT .'/cfc/content.php';
	$dbobject = new contentObj;
	
	// get data
	$where = "content_id=" .$_GET['content_id'];
	$qcontent = $dbobject->getData($where);
	
	foreach ($qcontent as $row) {
		$_POST['page_title'] = $row['page_title'];
		$_POST['filename'] = $row['filename'];
		$_POST['directory'] = $row['directory'];
	}
	
}

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/admin_content.php">Content</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>

<h1>Admin Content - <?php echo $_GET['mode']?> a Content item</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the content item below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="admin_content_form" id="admin_content_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?mode=<?php echo $_GET['mode']?>&content_id=<?php echo $_GET['content_id']?>" method="post">
	
    <fieldset>
    
    <input type="hidden" name="content_id" value="<?php echo $_GET['content_id']?>" />
    
	<div class="control-group<?php if($_GLOBALS['nav_item.error']){?> form_error<?php }?>">
      <label for="page_title" class="mandatory">Page Title:</label>
      <div class="controls">
        <input type="Text" name="page_title" id="page_title" class="textinput" value="<?php echo $_POST['page_title']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['filename.error']){?> form_error<?php }?>">
      <label for="filename" class="mandatory">Filename:</label>
      <div class="controls">
        <input type="Text" name="filename" id="filename" class="textinput" value="<?php echo $_POST['filename']?>" required />
      </div>
	</div>
	
	<div class="control-group<?php if($_GLOBALS['directory.error']){?> form_error<?php }?>">
      <label for="directory" class="mandatory">Directory:</label>
      <div class="controls">
        <input type="Text" name="directory" id="directory" class="textinput" value="<?php echo $_POST['directory']?>" required />
      </div>
	</div>
	
	<div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    
    </fieldset>
    
</form>

<?php require_once '../../common/footer.php'; ?>
