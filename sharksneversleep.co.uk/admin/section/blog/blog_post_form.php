<?php
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_GET['mode'])) $_GET['mode'] = 'add';
if(!isset($_GET['post_id'])) $_GET['post_id'] = '0';

// form params
if(!isset($_POST['category_id'])) $_POST['category_id'] = '';
if(!isset($_POST['author_id'])) $_POST['author_id'] = '';
if(!isset($_POST['post_title'])) $_POST['post_title'] = '';
if(!isset($_POST['post_date'])) $_POST['post_date'] = date('Y-m-d');
if(!isset($_POST['post_description'])) $_POST['post_description'] = '';
if(!isset($_POST['post_keywords'])) $_POST['post_keywords'] = '';
if(!isset($_POST['image_file'])) $_POST['image_file'] = '';
if(!isset($_POST['image_file_original'])) $_POST['image_file_original'] = '';
if(!isset($_POST['post_copy'])) $_POST['post_copy'] = '';
if(!isset($_POST['is_live'])) $_POST['is_live'] = '';

// error params
if(!isset($_GLOBALS['category_id.error'])) $_GLOBALS['category_id.error'] = false;
if(!isset($_GLOBALS['author_id.error'])) $_GLOBALS['author_id.error'] = false;
if(!isset($_GLOBALS['post_title.error'])) $_GLOBALS['post_title.error'] = false;
if(!isset($_GLOBALS['post_date.error'])) $_GLOBALS['post_date.error'] = false;
if(!isset($_GLOBALS['post_description.error'])) $_GLOBALS['post_description.error'] = false;
if(!isset($_GLOBALS['post_keywords.error'])) $_GLOBALS['post_keywords.error'] = false;
if(!isset($_GLOBALS['image_file.error'])) $_GLOBALS['image_file.error'] = false;
if(!isset($_GLOBALS['post_copy.error'])) $_GLOBALS['post_copy.error'] = false;
if(!isset($_GLOBALS['is_live.error'])) $_GLOBALS['is_live.error'] = false;

if(isset($_POST['submit'])){
	$load_defaults = false;
	include("blog_post_validation.php");
	if($success)include("blog_post_action.php");
}

// CFCs
require_once ROOT .'/cfc/blogpost.php';
$dbobject = new blogpostObj;

// get default values
if($_REQUEST['mode']=="edit" && $load_defaults){

	// get data
	$where = "post_id=" .$_GET['post_id'];
	$quser = $dbobject->getData($where);

	foreach ($quser as $row) {
		$_POST['category_id'] = $row['category_id'];
		$_POST['author_id'] = $row['author_id'];//
		$_POST['post_title'] = $row['post_title'];
		$_POST['post_date'] = date('Y-m-d',strtotime($row['post_date']));
    $_POST['post_description'] = $row['post_description'];
    $_POST['post_keywords'] = $row['post_keywords'];
    $_POST['image_file_original'] = $row['image_file'];
    $_POST['image_file'] = $row['image_file'];
		$_POST['post_copy'] = $row['post_copy'];
		$_POST['is_live'] = $row['is_live'];
	}
}

require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$where = '';
$qcat = $dbobject->getData($where);

require_once ROOT .'/cfc/blogauthor.php';
$dbobject = new blogauthorObj;
$where = '';
$qauthor = $dbobject->getData($where);

// header file
require_once '../../common/header.php';
// CMS editor
require_once '../../../includes/editor.php';
?>
<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li class="active"><?php echo $_GET['mode'] ?></li>
</ul>
<h1>Blog - <?php echo $_GET['mode']?> a post</h1>
<div class="alert alert-info">Please <?php echo $_GET['mode']?> the post below.</div>

<?php if($errMsg!=''){?>
<div class="alert alert-error"><?php echo $errMsg?></div>
<?php }?>

<form enctype="multipart/form-data" name="blog_post_form" id="blog_post_form" class="well" action="<?php echo $_SERVER['PHP_SELF']?>?post_id=<?php echo $_GET['post_id']?>&mode=<?php echo $_GET['mode']?>" method="post">

    <fieldset>

    <input type="hidden" name="post_id" value="<?php echo $_GET['post_id']?>" />
    <input type="hidden" name="image_file_original" value="<?php echo $_POST['image_file_original']?>" />

    <div class="control-group<?php if($_GLOBALS['category_id.error']){?> form_error<?php }?>">
      <label for="category_id" class="mandatory">Category:</label>
      <div class="controls">
        <select name="category_id" id="category_id" class="selectinput" required>
            <option value="">select category</option>
            <?php foreach ($qcat as $row) {?>
                <option value="<?php echo $row['category_id']?>"<?php if($_POST['category_id']==$row['category_id']){?> selected="selected"<?php }?>><?php echo $row['category']?></option>
            <?php }?>
        </select>
      </div>
	 </div>

    <div class="control-group<?php if($_GLOBALS['author_id.error']){?> form_error<?php }?>">
      <label for="author_id" class="mandatory">Author:</label>
      <div class="controls">
        <select name="author_id" id="author_id" class="selectinput" required>
            <option value="">select author</option>
            <?php foreach ($qauthor as $row) {?>
                <option value="<?php echo $row['author_id']?>"<?php if($_POST['author_id']==$row['author_id']){?> selected="selected"<?php }?>><?php echo $row['author_first_name']?> <?php echo $row['author_last_name']?></option>
            <?php }?>
        </select>
      </div>
	</div>

  <div class="control-group<?php if($_GLOBALS['post_title.error']){?> form_error<?php }?>">
      <label for="display_name" class="mandatory">Title:</label>
      <div class="controls">
        <input type="Text" name="post_title" id="post_title" class="textinput" value="<?php echo $_POST['post_title']?>" required />
      </div>
	</div>

  <div class="control-group<?php if($_GLOBALS['post_keywords.error']){?> form_error<?php }?>">
      <label for="display_name" class="mandatory">Keywords:</label>
      <div class="controls">
        <input type="Text" name="post_keywords" id="post_keywords" class="textinput" value="<?php echo $_POST['post_keywords']?>" />
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
  <img src="/images/blog/main/<?php echo $_POST['image_file']?>" height="150px" />
  </div>
  <?php } ?>

	<div class="control-group<?php if($_GLOBALS['post_date.error']){?> form_error<?php }?>">
      <label for="post_date" class="mandatory">Date:</label>
      <div class="controls">
        <input type="date" name="post_date" id="post_date" class="textinput" value="<?php echo $_POST['post_date']?>" required />
      </div>
	</div>

	<div class="control-group<?php if($_GLOBALS['post_description.error']){?> form_error<?php }?>">
      <label for="post_description" class="mandatory">Description:</label>
      <div class="controls">
        <textarea class="input-xlarge no-editor" name="post_description" id="post_description" rows="10" required><?php echo $_POST['post_description']?></textarea>
      </div>
	</div>

  <div class="control-group<?php if($_GLOBALS['post_copy.error']){?> form_error<?php }?>">
      <label for="post_copy" class="mandatory">Post:</label>
      <div class="controls">
        <textarea class="input-xlarge" name="post_copy" id="post_copy" rows="10"><?php echo $_POST['post_copy']?></textarea>
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
Modernizr.load({
  test: Modernizr.inputtypes && Modernizr.inputtypes.date,
  nope: [
    $('input[type=date]').datepicker({
      dateFormat: 'yy-mm-dd'
    })
  ]
});
</script>


