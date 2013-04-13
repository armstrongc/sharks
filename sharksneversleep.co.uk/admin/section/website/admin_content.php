<?php 
require_once '../../common/config.php';

// URL.params
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = '';
$_GLOBALS['action'] = $_GET['action'];

// CFCs
require_once ROOT .'/cfc/content.php';
$dbobject = new contentObj;
$dbobject->sql_orderby = 'display_order';

// delete?
if(isset($_GET['item_remove']) && $_GET['item_remove'] !=''){
	require_once 'admin_content_delete.php';
}

// reorder
if(isset($_GET['moved_item_id']) && $_GET['moved_item_id'] !=''){
	require_once 'admin_content_order.php';
}

// get data
$where = "";
$qcontent = $dbobject->getData($where);
$recordcount=$dbobject->numrows;

// header file
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/website/">Website Settings</a> <span class="divider">></span></li>
  <li class="active">Content</li>
</ul>

<h1>Admin Content</h1>
<div class="alert alert-info">Please select a page from the list below to edit or delete.</div>

<?php if($_GLOBALS['action']=='add'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Content Page Added Successfully!
    </div>
<?php } else if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Content Page Updated Successfully!
    </div>
<?php }else if($_GLOBALS['action']=='delete'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Content Page Deleted Successfully!
    </div>
<?php }else if($_GLOBALS['action']=='reorder'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Content Page Reordered Successfully!
    </div>
<?php }?>

<a class="btn btn-success btn-large add_link pull-right" href="admin_content_form.php?mode=add" title="add a new page">add a new page</a>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Page Title</th>
      <th class="action">Order</th>
      <th class="action">Update</th>
      <th class="action">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($qcontent as $row) {?>
  <tr>
      <td><?php echo $row['page_title']?></td>
      <td class="action">
          <form name="itemSortForm<?php echo $row['content_id']?>" id="itemSortForm<?php echo $row['content_id']?>" action="#CGI.script_name#" method="post" style="margin:0; padding:0;">
              <input type="Hidden" name="moved_item_id" value="<?php echo $row['content_id']?>">
              <input type="Hidden" name="current_display_order" value="<?php echo $row['display_order']?>">
              <select name="new_display_order" onchange="javascript:document.itemSortForm<?php echo $row['content_id']?>.submit();">
                  <?php for($x=1;$x<=$recordcount;$x++){?>
                      <option value="<?php echo $x?>" <?php if($x==$row['display_order']){?>selected="selected"<?php }?>><?php echo $x?></option>
                  <?php }?>
              </select>
          </form>
      </td>
      <td class="action"><a href="admin_content_form.php?content_id=<?php echo $row['content_id']?>&mode=edit" title="Update"><i class="icon-edit"></i></a></td>
      <td class="action"><a class="confirm-delete" data-type="Content Item" href="admin_content.php?item_remove=<?php echo $row['content_id']?>" title="Delete"><i class="icon-trash"></i></a></td>
  </tr>
  <?php }?>
  
  </tbody>
</table>

<?php require_once '../../common/footer.php'; ?>
