<?php
//require_once '../common/config.php';

$rewrite = '
RewriteEngine On
# Turn on the rewriting engine
# dynamic

ErrorDocument 404 /404.htm
ErrorDocument 500 /error.htm

RewriteRule ^sitemap.xml /sitemap.php  [NC,L]
RewriteRule ^rss.xml /rss.php  [NC,L]
RewriteRule ^privacy/cookie-policy /privacy/cookies.php  [NC,L]
RewriteRule ^privacy/privacy-policy /privacy/privacy.php  [NC,L]
';

require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$dbobject->sql_orderby = 'display_order';
// get data
$where = "is_live=1";
$qcats = $dbobject->getData($where);

foreach ($qcats as $row) {

  require_once ROOT .'/cfc/blogpost.php';
  $dbobject = new blogpostObj;
  $dbobject->sql_orderby = 'post_date';
  $where = "category_id=" .$row['category_id'] ." AND is_live=1";
  $qpost_all = $dbobject->getData($where);

  foreach ($qpost_all as $row2) {

    $initial = '^articles/' .gen_filename($row['category']) .'/' .gen_filename($row2['post_title']) .'/([A-Za-z0-9-]+)/';
    $converted = '/blog/index.php?post_id=' .$row2['post_id'] .'&category_id=' .$row['category_id'] .'&pg=$1' .' [NC,L]';
    $rule = '
RewriteRule ' .$initial .' ' .$converted;
  $rewrite .= $rule;

    $initial = '^articles/' .gen_filename($row['category']) .'/' .gen_filename($row2['post_title']) .'/';
    $converted = '/blog/index.php?post_id=' .$row2['post_id'] .'&category_id=' .$row['category_id'] .' [NC,L]';
    $rule = '
RewriteRule ' .$initial .' ' .$converted;
  $rewrite .= $rule;

  }

  $initial = '^articles/' .gen_filename($row['category']) .'/';
  $converted = '/blog/index.php?category_id=' .$row['category_id'] .' [NC,L]';
  $rule = '
RewriteRule ' .$initial .' ' .$converted;
  $rewrite .= $rule;

}

$rewrite .= '
RewriteRule ^articles/ /blog/index.php  [NC,L]
';

if($site_mode=="live"){
  file_put_contents ( ROOT .'/.htaccess' , $rewrite );
}else{
  echo 'not live';
}
?>