<?php 
// GET CONFIG
require_once '../../common/config.php';

// CFCs
require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$dbobject->sql_orderby = 'display_order';

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// delete?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	require_once 'blog_category_delete.php';
}

// reorder
if(isset($_POST['moved_item_id']) && $_POST['moved_item_id'] !=''){
	require_once 'blog_category_order.php';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'blog_category_is_live.php';
}

// get data
$where = "";
$qpost = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/blog_setup.php">Blog Setup</a> <span class="divider">></span></li>
  <li class="active">Blog Categories</li>
</ul>

<h1>Blog Categories</h1>
<div class="alert alert-info">Select an Blog Category from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog category added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog category updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog category deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='reorder'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog category reordered successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog category live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="blog_category_form.php?mode=add">add a new category</a>

<?php if($recordcount){ ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Category</th>
        <th class="action">Order</th>
        <th class="action">Live</th>
        <th class="action">Update</th>
        <th class="action">Delete</th>
      </tr>
    </thead>
    <tbody>
  
    <?php foreach ($qpost as $row) {?>   
      <tr>
        <td><?php echo $row['category']?></td>
        <td class="action">
        
			<form name="itemSortForm<?php echo $row['category_id']?>" id="itemSortForm<?php echo $row['category_id']?>" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0;">
				<input type="Hidden" name="moved_item_id" value="<?php echo $row['category_id']?>">
				<input type="Hidden" name="current_display_order" value="<?php echo $row['display_order']?>">
				<select name="new_display_order" onchange="javascript:document.itemSortForm<?php echo $row['category_id']?>.submit();">
					<?php for($x=1;$x<=$recordcount;$x++){?>
						<option value="<?php echo $x?>" <?php if($x==$row['display_order']){?>selected="selected"<?php }?>><?php echo $x?></option>
					<?php }?>
				</select>
			</form>
       
		</td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Category" href="blog_category.php?item_live=0&item_id=<?php echo $row['category_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Category" href="blog_category.php?item_live=1&item_id=<?php echo $row['category_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="blog_category_form.php?category_id=<?php echo $row['category_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="Category" href="blog_category.php?item_remove=<?php echo $row['category_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
     </tr>
    <?php }?>
    </tbody>
  </table>

<?php } else { ?>
<div class="pull-left">
There are currently no categories available.
</div>
<?php }?>

<?php require_once '../../common/footer.php'; ?>