<?php
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['comment_id'])) $_GET['comment_id'] = '0';
if(!isset($_GET['post_id'])) $_GET['post_id'] = '0';

// form params
if(!isset($_POST['comment_name'])) $_POST['comment_name'] = '';
if(!isset($_POST['comment_email'])) $_POST['comment_email'] = '';
if(!isset($_POST['comment_location'])) $_POST['comment_location'] = '';
if(!isset($_POST['comment_copy'])) $_POST['comment_copy'] = '';
//if(!isset($_POST['comment_date'])) $_POST['comment_date'] = date('Y-m-d');
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';

// error params
if(!isset($_GLOBALS['comment_name.error'])) $_GLOBALS['comment_name.error'] = false;
if(!isset($_GLOBALS['comment_email.error'])) $_GLOBALS['comment_email.error'] = false;
if(!isset($_GLOBALS['comment_location.error'])) $_GLOBALS['comment_location.error'] = false;
if(!isset($_GLOBALS['comment_copy.error'])) $_GLOBALS['comment_copy.error'] = false;
//if(!isset($_GLOBALS['comment_date.error'])) $_GLOBALS['comment_date.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("blog_comment_validation.php");
	if($success)include("blog_comment_action.php");
}

// CFCs
require_once ROOT .'/cfc/blogcomment.php';
$dbobject = new blogcommentObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "comment_id=" .$_GET['comment_id'];
	$quser = $dbobject->getData($where);

	foreach ($quser as $row) {
		$_POST['comment_name'] = $row['comment_name'];
		$_POST['comment_email'] = $row['comment_email'];
		$_POST['comment_location'] = $row['comment_location'];
		$_POST['comment_copy'] = $row['comment_copy'];
    //$_POST['comment_date'] = date('Y-m-d',strtotime($row['comment_date']));
		$_POST['is_live'] = $row['is_live'];
	}
}

// header file
require_once '../../common/header.php';

// CMS editor
require_once '../../../includes/editor.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/blog_comment.php?post_id=<?php echo $_GET['post_id'] ?>">Blog Comments</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>Blog Comments - <?php echo $_GET['mode']?> a comment</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the comment below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form name="blog_comment_form" id="blog_comment_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?post_id=<?php echo $_GET['post_id']?>&comment_id=<?php echo $_GET['comment_id']?>&mode=<?php echo $_GET['mode']?>" method="post">

    <fieldset>

    <input type="hidden" name="comment_id" value="<?php echo $_GET['comment_id']?>" />
    <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']?>" />

	<div class="control-group<?php if($_GLOBALS['comment_name.error']){?> form_error<?php }?>">
      <label for="comment_name" class="mandatory">Name:</label>
      <div class="controls">
        <input type="Text" name="comment_name" id="comment_name" class="textinput" value="<?php echo $_POST['comment_name']?>" required />
      </div>
	</div>


  <!--
  <div class="control-group<?php if($_GLOBALS['comment_email.error']){?> form_error<?php }?>">
      <label for="comment_email" class="mandatory">Email:</label>
      <div class="controls">
        <input type="email" name="comment_email" id="comment_email" class="textinput" value="<?php echo $_POST['comment_email']?>" />
      </div>
	</div> -->

    <div class="control-group<?php if($_GLOBALS['comment_location.error']){?> form_error<?php }?>">
      <label for="comment_location" class="mandatory">Location:</label>
      <div class="controls">
        <input type="Text" name="comment_location" id="comment_location" class="textinput" value="<?php echo $_POST['comment_location']?>" required />
      </div>
	</div>

    <div class="control-group<?php if($_GLOBALS['comment_copy.error']){?> form_error<?php }?>">
      <label for="comment_copy" class="mandatory">Copy:</label>
      <div class="controls">
        <textarea class="input-xlarge" name="comment_copy" id="comment_copy" rows="10"><?php echo $_POST['comment_copy']?></textarea>
      </div>
	</div>

    <!--
  <div class="control-group<?php if($_GLOBALS['comment_date.error']){?> form_error<?php }?>">
      <label for="comment_date" class="mandatory">Date:</label>
      <div class="controls">
        <input type="date" name="comment_date" id="comment_date" class="textinput" value="<?php echo $_POST['comment_date']?>" required />
      </div>
	</div> -->

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
Modernizr.load({
  test: Modernizr.inputtypes && Modernizr.inputtypes.date,
  nope: [
    $('input[type=date]').datepicker({
      dateFormat: 'yy-mm-dd'
    })
  ]
});
</script>