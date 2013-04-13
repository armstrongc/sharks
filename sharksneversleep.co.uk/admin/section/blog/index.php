<?php 
// GET CONFIG
require_once '../../common/config.php';

// CFCs
require_once ROOT .'/cfc/blogpost.php';
$dbobject = new blogpostObj;

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// DELETE?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	$_GLOBALS['post_id']=$_GET['item_remove'];
	$fieldarray = $dbobject->deleteRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	$_GLOBALS['action']='delete';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'blog_post_is_live.php';
}

// get data
$where = "";
$dbobject->sql_orderby = 'post_date DESC';
$qpost = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Blog</li>
</ul>

<h1>Blog</h1>
<div class="alert alert-info">Select an Blog Post from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog post added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog post updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog post deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog post live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="blog_post_form.php?mode=add">add a new post</a>
<a class="btn btn-danger btn-large add_link pull-right" href="blog_setup.php">setup</a>

<?php if($recordcount){ ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Date</th>
        <th class="action">Comments</th>
        <th class="action">Live</th>
        <th class="action">Update</th>
        <th class="action">Delete</th>
      </tr>
    </thead>
    <tbody>
  
    <?php foreach ($qpost as $row) {?>   
      <tr>
      
        <td><?php echo $row['post_title']?></td>
        <td><?php echo date("jS F Y", strtotime($row['post_date'])); ?></td>
        <td class="action"><a href="blog_comment.php?post_id=<?php echo $row['post_id']?>" title="Comments"><i class="icon-comment"></i></a></td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Navigation Item" href="index.php?item_live=0&item_id=<?php echo $row['post_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Navigation Item" href="index.php?item_live=1&item_id=<?php echo $row['post_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="blog_post_form.php?post_id=<?php echo $row['post_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="User" href="index.php?item_remove=<?php echo $row['post_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
     </tr>
    <?php }?>
    </tbody>
  </table>

<?php } else { ?>
<div class="pull-left">
There are currently no posts available.
</div>
<?php }?>

<?php require_once '../../common/footer.php'; ?>