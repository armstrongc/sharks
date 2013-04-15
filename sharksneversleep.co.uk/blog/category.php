
<div class="container_12 clearfix" role="main">

    <div class="grid_12">
        <nav class="blog_breadcrumb">
            <ul>
                <li><a href="/">Home</a></li>
                <li>&gt;</li>
                <li><a href="/blog/">Blog</a></li>
                <li>&gt;</li>
                <li><a href="/blog/<?php echo gen_filename($qcat[0]['category']) ?>/"><?php echo $qcat[0]['category']; ?></a></li>
            </ul>
        </nav>
    </div>

    <div class="clear"></div>



    <!-- Blog Post -->
    <article class="grid_8">

        <h2><?php echo $qcat[0]['category']; ?></h2>
        <p class="blog_category_description"><?php echo $qcat[0]['category_description']; ?></p>

        <?php foreach ($qpost_all as $row) {

            $dbobject = new blogcategoryObj;
            $where = "category_id=" .$row['category_id'] ." AND is_live=1";
            $qcat = $dbobject->getData($where);

            $initial_cat = '/blog/' .gen_filename($qcat[0]['category']) .'/';
            $initial = $initial_cat .gen_filename($row['post_title']) .'/';
            //echo '<a href="' . $initial .'">' .$row["post_title"] .'</a><br />';
            //echo '<a href="' . $initial .'"><img src="/images/blog/main/' .$row["image_file"] .'" class="home_gallery_thumb" /></a>';
            echo '<div class="blog_link_post_row">';
            echo '<h3 class="blog_link_post_title"><a href="' . $initial .'">' .$row["post_title"] .'</a></h3>';
            echo '<div class="blog_link_post_description">' .$row["post_description"] .'</div>';
            echo '<div class="blog_link_post_date"><a href="' . $initial .'">READ POST</a> | <a href="' .$initial_cat .'">' .$qcat[0]['category'] .'</a> | ' .date('l jS F Y',strtotime($row['post_date'])) .'</div>';
            echo '</div>';

            //$initial = '/blog/' .gen_filename($qcat[0]['category']) .'/' .gen_filename($row['post_title']) .'/';
            //echo '<a href="' . $initial .'">' .$row["post_title"] .'</a><br />';
            //echo '<a href="' . $initial .'"><img src="/images/blog/main/' .$row["image_file"] .'" class="home_gallery_thumb" /></a>';
        }?>
    </article>
    <div class="grid_1">&nbsp;</div>
    <aside class="grid_3">
        <?php require_once 'blog_subnav.php'; ?>
    </aside>

    <div class="clear" style="height:10px;"></div>

</div> <!-- /container -->
