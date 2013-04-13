<?php
require_once '../common/config.php';
require_once '../common/header.php';
?>

<ul class="breadcrumb">
  <li class="active">Home</li>
</ul>

<?php require_once ROOT .'/admin/urlrewrite/rewrite.php' ?>

<div class="row-fluid">
  <div class="span12">
    <h2>URL Rewrite</h2>
    <textarea style="width:500px; height:500px;">
    <?php echo $rewrite; ?>
    </textarea>
  </div><!--/span-->
</div><!--/row-->

<?php require_once '../common/footer.php'; ?>