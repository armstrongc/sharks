<?php
require_once 'common/config.php';
header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">';

require_once ROOT .'/cfc/blogcategory.php';
$dbobject = new blogcategoryObj;
$dbobject->sql_orderby = 'display_order';
// get data
$where = "is_live=1";
$qcats = $dbobject->getData($where);

echo
    '
        <channel>
        <title>Sharks Never Sleep Blog</title>
        <link>www.sharksneversleep.co.uk/blog</link>
        <description>Website design and development blog</description>
        <language>en-gb</language>
        <copyright>Copyright (c) ' .date('Y') .' www.sharksneversleep.co.uk</copyright>';

foreach ($qcats as $row) {

    require_once ROOT .'/cfc/blogpost.php';
    $dbobject = new blogpostObj;
    $dbobject->sql_orderby = 'post_date';
    $where = "category_id=" .$row['category_id'] ." AND is_live=1";
    $qpost_all = $dbobject->getData($where);

    foreach ($qpost_all as $row2) {

        $title = $row2['post_title'];
        $description = $row2['post_description'];
        $url = 'http://www.sharksneversleep.co.uk/blog/' .gen_filename($row['category']) .'/' .gen_filename($row2['post_title']) .'/';
        $date = date('Y-m-d',strtotime($row2['post_date']));

    echo
    '
        <item>
        <title>' .$title .'</title>
        <description>' .$description .'</description>
        <link>' .$url .'</link>
        <pubDate>'.$date.'</pubDate>
        </item>
    ';

    }

}

echo
    '
        </channel>
    ';

echo
'</rss>';
?>
