<?php
// GET CONFIG
require_once '../../common/config.php';

if(!isset($_GET['post_id'])) $_GET['post_id'] = '0';

require_once ROOT .'/cfc/blogpost.php';
$dbobject = new blogpostObj;
$where = "post_id=" .$_GET['post_id'];
$qpost = $dbobject->getData($where);

$_GLOBALS['post_title']=$qpost[0]['post_title'];

// CFCs
require_once ROOT .'/cfc/blogcomment.php';
$dbobject = new blogcommentObj;

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// DELETE?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	$_GLOBALS['comment_id']=$_GET['item_remove'];
	$fieldarray = $dbobject->deleteRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	$_GLOBALS['action']='delete';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'blog_comment_is_live.php';
}

// get data
$where = "post_id='" .$_GET['post_id'] ."'";
$qpost = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li>Comments</li>
</ul>

<h1>Blog Comments</h1>
<div class="alert alert-info"><strong><?php echo $_GLOBALS['post_title']; ?></strong>
</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog comment added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog comment updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog comment deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog comment live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="blog_comment_form.php?post_id=<?php echo $_GET['post_id'] ?>&mode=add">add a new comment</a>

<?php if($recordcount){ ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th class="action">Live</th>
        <th class="action">Update</th>
        <th class="action">Delete</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach ($qpost as $row) {?>
      <tr>
        <td><?php echo date("jS F Y H:i:s", strtotime($row['comment_date'])); ?></td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Comment" href="blog_comment.php?post_id=<?php echo $row['post_id']?>&item_live=0&item_id=<?php echo $row['comment_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Comment" href="blog_comment.php?post_id=<?php echo $row['post_id']?>&item_live=1&item_id=<?php echo $row['comment_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="blog_comment_form.php?post_id=<?php echo $row['post_id']?>&comment_id=<?php echo $row['comment_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="Comment" href="blog_comment.php?post_id=<?php echo $row['post_id']?>&item_remove=<?php echo $row['comment_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
     </tr>
    <?php }?>
    </tbody>
  </table>

<?php } else { ?>
<div class="pull-left">
There are currently no comments available.
</div>
<?php }?>

<?php require_once '../../common/footer.php'; ?>