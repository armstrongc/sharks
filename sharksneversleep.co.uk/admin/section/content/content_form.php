<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'edit';
if(!isset($_GET['content_id'])) $_GET['content_id'] = '0';

// form params
if(!isset($_POST['content'])) $_POST['last_name'] = '';

// error params
if(!isset($_GLOBALS['content.error'])) $_GLOBALS['content.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("content_validation.php");
	if($success)include("content_action.php");
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
		$_POST['content'] = $row['content'];
	}
}

// header file
require_once '../../common/header.php';
// CMS editor
require_once '../../../includes/editor.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/content/">Content</a> <span class="divider">></span></li>
  <li class="active">Edit Content</li>
</ul>

<h1><?php echo $_REQUEST['page_title']?> (edit)</h1>
<div class="alert alert-info">Please edit the content item below.</div>

<form class="well" name="content_form" id="content_form" action="<?php echo $_SERVER['PHP_SELF']?>?content_id=<?php echo $_GET['content_id']?>" method="post">
  <fieldset>
	
    <input type="hidden" name="content_id" value="<?php echo $_GET['content_id']?>" />
    
    <div class="control-group<?php if($_GLOBALS['content.error']){?> form_error<?php }?>">
      <label class="control-label" for="content">Textarea</label>
      <div class="controls">
        <textarea class="input-xlarge" name="content" id="content" rows="10"><?php echo $_POST['content']?></textarea>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Save changes</button>
    </div>
  </fieldset>
</form>


<?php require_once '../../common/footer.php'; ?>