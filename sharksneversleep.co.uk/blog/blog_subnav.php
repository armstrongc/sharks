<div class="blog_sub_nav_container">
<h3>Categories</h3>
<div class="blog_sub_nav clearfix">
    <a href="/blog/">ALL POSTS</a>
    <?php foreach ($qcats as $row) {

        $dbobject = new blogpostObj;
        $where = "category_id=" .$row['category_id'] ." AND is_live=1";
        $qposts = $dbobject->getData($where);
        $recordcount=$dbobject->numrows;

        if($recordcount){
            $initial = '/'. $blog_url .'/' .gen_filename($row['category']) .'/';
            echo '<a href="' . $initial .'">' .$row["category"] .' (' .$recordcount .')</a>';
        }
    }?>
</div>

<?php if($_GET['category_id']!=0){?>
    <h3>Latest <?php echo $qcat[0]['category']; ?> posts</h3>
    <div class="blog_sub_nav clearfix">
        <?php foreach ($qpost_all as $row) {

            $dbobject = new blogcategoryObj;
            $where = "category_id=" .$row['category_id'] ." AND is_live=1";
            $qcat = $dbobject->getData($where);

            $initial = '/'. $blog_url .'/' .gen_filename($qcat[0]['category']) .'/' .gen_filename($row['post_title']) .'/';
            echo '<a href="' . $initial .'">' .$row["post_title"] .'</a>';
        }?>
    </div>

<?php } ?>
</div>
