<?php
require_once 'common/config.php';
header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';

require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$dbobject->sql_orderby = 'display_order';
// get data
$where = "is_live=1";
$qcats = $dbobject->getData($where);

echo
    '
        <url>
        <loc>http://www.sharksneversleep.co.uk</loc>
        <lastmod>2013-02-12</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
        </url>
        <url>
        <loc>http://www.sharksneversleep.co.uk/blog/</loc>
        <lastmod>2013-02-12</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
        </url>
    ';

foreach ($qcats as $row) {

    require_once ROOT .'/cfc/blogpost.php';
    $dbobject = new blogpostObj;
    $dbobject->sql_orderby = 'post_date';
    $where = "category_id=" .$row['category_id'] ." AND is_live=1";
    $qpost_all = $dbobject->getData($where);

    $url = 'http://www.sharksneversleep.co.uk/blog/' .gen_filename($row['category']) .'/';

    echo
    '
        <url>
        <loc>'.$url.'</loc>
        <lastmod>2013-02-12</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
        </url>
    ';

    foreach ($qpost_all as $row2) {

        $url = 'http://www.sharksneversleep.co.uk/blog/' .gen_filename($row['category']) .'/' .gen_filename($row2['post_title']) .'/';
        $date = date('Y-m-d',strtotime($row2['post_date']));

    echo
    '
        <url>
        <loc>'.$url.'</loc>
        <lastmod>'.$date.'</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
        </url>
    ';

    }

}

echo
'
<url>
<loc>http://www.sharksneversleep.co.uk/contact/</loc>
<lastmod>2013-02-12</lastmod>
<changefreq>weekly</changefreq>
<priority>0.7</priority>
</url>
<url>
<loc>http://www.sharksneversleep.co.uk/privacy/privacy-policy/</loc>
<lastmod>2013-02-12</lastmod>
<changefreq>weekly</changefreq>
<priority>0.7</priority>
</url>
<url>
<loc>http://www.sharksneversleep.co.uk/privacy/cookie-policy/</loc>
<lastmod>2013-02-12</lastmod>
<changefreq>weekly</changefreq>
<priority>0.7</priority>
</url>
</urlset>';
?>
