<?php 
// GET CONFIG
require_once '../../common/config.php';

// URL.params
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = '';
$_GLOBALS['action'] = $_GET['action'];

// get content extended class
require_once ROOT .'/cfc/adminNavigation.php';
$dbobject = new adminNavigationObj;
$dbobject->sql_orderby = 'display_order';

// delete?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	require_once 'admin_navigation_delete.php';
}

// reorder
if(isset($_POST['moved_item_id']) && $_POST['moved_item_id'] !=''){
	require_once 'admin_navigation_order.php';
}

// live
if(isset($_GET['item_live']) && $_GET['item_live'] !=''){
	require_once 'admin_navigation_is_live.php';
}

// get data
$where = "";
$qnavadmin = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li class="active">Admin Navigation</li>
</ul>

<h1>Admin Navigation</h1>
<div class="alert alert-info">Please select a nav item from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Navigation item successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Navigation updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Navigation deleted successfully.
    </div>
<?php }else if($_GLOBALS['action']=='reorder'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Navigation reordered successfully.
    </div>
<?php }else if($_GLOBALS['action']=='live'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Navigation live status updated successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="admin_navigation_form.php?mode=add">add a new nav item</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Username</th>
      <th class="action">Order</th>
      <th class="action">Live</th>
      <th class="action">Update</th>
      <th class="action">Delete</th>
    </tr>
  </thead>
  <tbody>
	
	<?php foreach ($qnavadmin as $row) {?>
	
	<tr>
		<td><?php echo $row['nav_item']?></td>
		<td class="action">
        
			<form name="itemSortForm<?php echo $row['admin_nav_id']?>" id="itemSortForm<?php echo $row['admin_nav_id']?>" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0;">
				<input type="Hidden" name="moved_item_id" value="<?php echo $row['admin_nav_id']?>">
				<input type="Hidden" name="current_display_order" value="<?php echo $row['display_order']?>">
				<select name="new_display_order" onchange="javascript:document.itemSortForm<?php echo $row['admin_nav_id']?>.submit();">
					<?php for($x=1;$x<=$recordcount;$x++){?>
						<option value="<?php echo $x?>" <?php if($x==$row['display_order']){?>selected="selected"<?php }?>><?php echo $x?></option>
					<?php }?>
				</select>
			</form>
       
		</td>
        <td class="action">
            <?php if($row['is_live']){?>
				<a class="confirm-live" data-type="Navigation Item" href="admin_navigation.php?item_live=0&item_id=<?php echo $row['admin_nav_id']?>" title="Make not live"><i class="icon-ok"></i></a>
			<?php }else{?>
				<a class="confirm-live" data-type="Navigation Item" href="admin_navigation.php?item_live=1&item_id=<?php echo $row['admin_nav_id']?>" title="Make not live"><i class="icon-remove"></i></a>
			<?php }?>
		</td>
        <td class="action"><a href="admin_navigation_form.php?admin_nav_id=<?php echo $row['admin_nav_id']?>&mode=edit" title="edit"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="Navigation Item" href="admin_navigation.php?item_remove=<?php echo $row['admin_nav_id']?>" title="delete"><i class="icon-trash"></i></a></td>
	</tr>
	
	<?php }?>
    </tbody>
</table>

<?php require_once '../../common/footer.php'; ?>
