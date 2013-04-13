<?php 
require_once '../../common/config.php';
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li class="active">Website Settings</li>
</ul>

<h1>Website Settings</h1>
<div class="module">
	<ul>
        <li><a href="admin_navigation.php">Add/edit/delete Admin Nav Items</a></li>
        <li><a href="admin_content.php">Add/edit/delete Admin Content Items</a></li>
        <li><a href="admin_access.php">Add/edit/delete Admin Access Types</a></li>
    </ul>
</div>
				
<?php require_once '../../common/footer.php'; ?>