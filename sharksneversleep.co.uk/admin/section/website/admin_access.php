<?php 
require_once '../../common/config.php';

// URL.params
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = '';
$_GLOBALS['action'] = $_GET['action'];

// CFCs
require_once ROOT .'/cfc/adminAccess.php';
$dbobject = new adminAccessObj;

// delete?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	require_once 'admin_access_delete.php';
}

// get data
$where = "";
$qaccess = $dbobject->getData($where);

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li class="active">Admin Access</li>
</ul>

<h1>Admin Access Types</h1>
<div class="alert alert-info">Please select an access type from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Access Type Added Successfully!
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Access Type Updated Successfully!
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin Access Type Deleted Successfully!
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="admin_access_form.php?mode=add" title="add a new admin access type">add a new admin access type</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Access Type</th>
      <th class="action">Update</th>
      <th class="action">Delete</th>
    </tr>
  </thead>
  <tbody>
	
  <?php foreach ($qaccess as $row) {?>
  <tr>
      <td><?php echo $row['admin_access_type']?></td>
      <?php if($row['admin_access_type_id'] >= 4){?>
          <td class="action"><a href="admin_access_form.php?admin_access_type_id=<?php echo $row['admin_access_type_id']?>&mode=edit" title="edit"><i class="icon-edit"></i></a></td>
          <td class="action"><a class="confirm-delete" data-type="Admin Access Item" href="admin_access.php?item_remove=<?php echo $row['admin_access_type_id']?>" title="delete"><i class="icon-trash"></i></a></td>
      <?php }else{ ?>
      	<td></td>
        <td></td>
	  <?php }?>
  </tr>
  <?php }?>
	
  </tbody>
</table>

<?php require_once '../../common/footer.php'; ?>
