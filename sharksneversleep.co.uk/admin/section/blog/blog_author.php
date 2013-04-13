<?php 
// GET CONFIG
require_once '../../common/config.php';

// CFCs
require_once ROOT .'/cfc/blogauthor.php';
$dbobject = new blogauthorObj;

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// DELETE?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	$_GLOBALS['author_id']=$_GET['item_remove'];
	$fieldarray = $dbobject->deleteRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	$_GLOBALS['action']='delete';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'blog_author_is_live.php';
}

// get data
$where = "";
$qauthor = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/blog_setup.php">Blog Setup</a> <span class="divider">></span></li>
  <li class="active">Blog Authors</li>
</ul>

<h1>Blog Authors</h1>
<div class="alert alert-info">Select an author from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog author added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog author updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog author deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Blog author live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="blog_author_form.php?mode=add">add a new author</a>

<?php if($recordcount){ ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Author</th>
        <th class="action">Live</th>
        <th class="action">Update</th>
        <th class="action">Delete</th>
      </tr>
    </thead>
    <tbody>
  
    <?php foreach ($qauthor as $row) {?>   
      <tr>
        <td><?php echo $row['author_first_name']?> <?php echo $row['author_last_name']?></td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Author" href="blog_author.php?item_live=0&item_id=<?php echo $row['author_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Author" href="blog_author.php?item_live=1&item_id=<?php echo $row['author_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="blog_author_form.php?author_id=<?php echo $row['author_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="Author" href="blog_author.php?item_remove=<?php echo $row['author_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
     </tr>
    <?php }?>
    </tbody>
  </table>

<?php } else { ?>
<div class="pull-left">
There are currently no authors available.
</div>
<?php }?>

<?php require_once '../../common/footer.php'; ?>