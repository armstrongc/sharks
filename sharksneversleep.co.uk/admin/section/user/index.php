<?php 
// GET CONFIG
require_once '../../common/config.php';

// URL PARAMS
if(!isset($_GET['action'])) $_GET['action']='';
$_GLOBALS['action'] = $_GET['action'];

// CFCs
require_once ROOT .'/cfc/user.php';
$dbobject = new userObj;

// DELETE?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	
	$_GLOBALS['is_deleted']=1;
	$_GLOBALS['user_id']=$_GET['item_remove'];
	
	$fieldarray = $dbobject->updateRecord($_GLOBALS);
	$errors = $dbobject->getErrors();
	
	$_GLOBALS['action']='delete';
}

// get data
$where = "is_deleted=0";
$dbobject->sql_from= 'tbluser u INNER JOIN tbladminaccesstype aat ON u.admin_access_type_id = aat.admin_access_type_id';
$quser = $dbobject->getData($where);

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Users</li>
</ul>

<h1>User Management</h1>
<div class="alert alert-info">Select an Admin user from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin User added successfully.
    </div>
<?php }else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin User updated successfully.
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Admin User deleted successfully.
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="user_form.php?mode=add">add a new user</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Username</th>
      <th>Access</th>
      <th class="action">Update</th>
      <th class="action">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($quser as $row) {?>   
      <?php if($row['admin_access_type_id'] != 1 || $_SESSION['admin_access_type_id'] == 1){ ?>
      <tr>
      	<td><?php echo $row['first_name']?> <?php echo $row['last_name']?></td>
        <td><?php echo $row['admin_access_type']?></td>
        <td class="action"><a href="user_form.php?user_id=<?php echo $row['user_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
        <td class="action"><a class="confirm-delete" data-type="User" href="index.php?item_remove=<?php echo $row['user_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
       </tr>
      <?php }?>
  <?php }?>
  </tbody>
</table>


<?php require_once '../../common/footer.php'; ?>