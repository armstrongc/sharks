<?php
require_once 'common/config.php';
require_once 'common/header.php';
?>

<ul class="breadcrumb">
  <li class="active">Home</li>
</ul>

<div class="leaderboard">
  <h1>Welome to the Content management System</h1>
  <p>Please choose an option from one of the areas below.</p>

<?php
/*
echo '$info_amended: ' .$info_amended;
echo '<br />';
echo '$info: ' .count($info);
echo '<br />';
echo '$primaryDir: ' .$primaryDir;
echo '<br />';
echo '$secondaryDir: ' .$secondaryDir;
echo '<br />';
echo 'ROOT: ' .ROOT;
*/
?>


</div>
<div class="row-fluid">
  <div class="span4">
    <h2>Content</h2>
    <p>Edit textual content areas across the site.</p>
    <p><a class="btn btn-success btn-large" href="section/content/">Manage Content</a></p>
  </div><!--/span-->
  <div class="span4">
    <h2>Blog</h2>
    <p>Manage the blog and commenting system.</p>
    <p><a class="btn btn-success btn-large" href="section/blog/">Manage Blog</a></p>
  </div><!--/span-->
  <div class="span4">
    <h2>Gallery</h2>
    <p>Create and manage galleries and upload images.</p>
    <p><a class="btn btn-success btn-large" href="section/gallery/">Manage Gallery</a></p>
  </div><!--/span-->
</div><!--/row-->

<?php require_once 'common/footer.php'; ?>