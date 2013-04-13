<?php 
// GET CONFIG
require_once '../../common/config.php';

// CFCs
require_once ROOT .'/cfc/gallery.php';
$dbobject = new galleryObj;

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// DELETE?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	require_once 'gallery_delete.php';
}

// reorder
if(isset($_POST['moved_item_id']) && $_POST['moved_item_id'] !=''){
	require_once 'gallery_order.php';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'gallery_is_live.php';
}

// get data
$where = "";
$dbobject->sql_orderby = 'display_order ASC';
$qpost = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Gallery</li>
</ul>

<h1>Gallery</h1>
<div class="alert alert-info">Select a Gallery from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Gallery added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Gallery updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Gallery deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='reorder'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Gallery reordered successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Gallery live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="gallery_form.php?mode=add">add a new gallery</a>

<?php if($recordcount){ ?>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Gallery</th>
        <th class="action">Order</th>
        <th class="action">Images</th>
        <th class="action">Live</th>
        <th class="action">Update</th>
        <th class="action">Delete</th>
      </tr>
    </thead>
    <tbody>
  
    <?php foreach ($qpost as $row) {?>   
      <tr>       
        <td><?php echo $row['gallery_name']?></td>
        <td class="action">
        
			<form name="itemSortForm<?php echo $row['gallery_id']?>" id="itemSortForm<?php echo $row['gallery_id']?>" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0;">
				<input type="Hidden" name="moved_item_id" value="<?php echo $row['gallery_id']?>">
				<input type="Hidden" name="current_display_order" value="<?php echo $row['display_order']?>">
				<select name="new_display_order" onchange="javascript:document.itemSortForm<?php echo $row['gallery_id']?>.submit();">
					<?php for($x=1;$x<=$recordcount;$x++){?>
						<option value="<?php echo $x?>" <?php if($x==$row['display_order']){?>selected="selected"<?php }?>><?php echo $x?></option>
					<?php }?>
				</select>
			</form>
       
		</td> 
        <td class="action"><a href="gallery_image.php?gallery_id=<?php echo $row['gallery_id']?>" title="Images"><i class="icon-th-list"></i></a></td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Gallery Item" href="index.php?item_live=0&item_id=<?php echo $row['gallery_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Gallery Item" href="index.php?item_live=1&item_id=<?php echo $row['gallery_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="gallery_form.php?gallery_id=<?php echo $row['gallery_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="Gallery" href="index.php?item_remove=<?php echo $row['gallery_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
     </tr>
    <?php }?>
    </tbody>
  </table>

<?php } else { ?>
<div class="pull-left">
There are currently no galleries available.
</div>
<?php }?>

<?php require_once '../../common/footer.php'; ?>