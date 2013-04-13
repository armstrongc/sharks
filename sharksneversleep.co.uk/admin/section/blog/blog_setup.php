<?php 
// GET CONFIG
require_once '../../common/config.php';
require_once '../../common/header.php';
?>

<ul class="breadcrumb">
  <li><a href="<?php echo $site_url ?>/">Home</a> <span class="divider">></span></li>
  <li><a href="<?php echo $site_url ?>/section/blog/">Blog</a> <span class="divider">></span></li>
  <li class="active">Blog Setup</li>
</ul>

<h1>Blog Setup</h1>
<div class="alert alert-info">Select an option below.</div>

<a class="btn btn-success btn-large add_link pull-right" href="blog_category.php">Categories</a>
<a class="btn btn-success btn-large add_link pull-right" href="blog_author.php">Authors</a>

<?php require_once '../../common/footer.php'; ?>