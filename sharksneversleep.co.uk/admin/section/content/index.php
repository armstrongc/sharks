<?php 
require_once '../../common/config.php';
$success = true;
$load_defaults = true;
$errMsg = '';

// URL.params
if(!isset($_REQUEST['action'])) $_REQUEST['action'] = '';
$_GLOBALS['action'] = $_GET['action'];

// CFCs
require_once ROOT .'/cfc/content.php';
$dbobject = new contentObj;
$dbobject->sql_orderby = 'display_order';

// get data
$where = "";
$qcontent = $dbobject->getData($where);

require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Content</li>
</ul>

<h1>Content</h1>

<div class="alert alert-info">
  Select a content item from the list below to edit.
</div>

<div class="message-area">
<?php if($_GLOBALS['action']=='edit'){?>
	<div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      <strong>Success!</strong> Content item updated successfully.
    </div>
<?php }?>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Page Title</th>
      <th class="action">Update</th>
    </tr>
  </thead>
  <tbody>
   
	<?php foreach ($qcontent as $row) {?>
    <tr>
      <td><?php echo $row['page_title']?></td>
      <td class="action"><a href="content_form.php?content_id=<?php echo $row['content_id']?>" title="Update"><i class="icon-edit"></i></a></td>
    </tr>
	<?php }?>

  </tbody>
</table>

<?php require_once '../../common/footer.php'; ?>
