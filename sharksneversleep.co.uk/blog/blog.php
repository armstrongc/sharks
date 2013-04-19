
<div class="container_12 clearfix" role="main">

    <!-- BREADCRUMB -->
    <div class="grid_12">
        <nav class="blog_breadcrumb">
            <ul>
                <li><a href="/">Home</a></li>
                <li>&gt;</li>
                <li><a href="/<?php echo $blog_url ?>/">Articles</a></li>
            </ul>
        </nav>
    </div>

    <div class="clear"></div>



    <!-- Blog Post listing -->
    <article class="grid_8">

        <h2 class="blog_category_header">Latest Posts</h2>
        <p class="blog_category_description">Browse through all of the posts available, or filter from the category listings</p>

        <?php foreach ($qpost_all as $row) {

            $dbobject = new blogcategoryObj;
            $where = "category_id=" .$row['category_id'] ." AND is_live=1";
            $qcat = $dbobject->getData($where);

            $initial_cat = '/'. $blog_url .'/' .gen_filename($qcat[0]['category']) .'/';
            $initial = $initial_cat .gen_filename($row['post_title']) .'/';
            //echo '<a href="' . $initial .'">' .$row["post_title"] .'</a><br />';
            //echo '<a href="' . $initial .'"><img src="/images/blog/main/' .$row["image_file"] .'" class="home_gallery_thumb" /></a>';
            echo '<div class="blog_link_post_row">';
            echo '<h3 class="blog_link_post_title"><a href="' . $initial .'">' .$row["post_title"] .'</a></h3>';
            echo '<div class="blog_link_post_description">' .$row["post_description"] .'</div>';
            echo '<div class="blog_link_post_date"><a href="' . $initial .'">READ POST</a> | <a href="' .$initial_cat .'">' .$qcat[0]['category'] .'</a> | ' .date('l jS F Y',strtotime($row['post_date'])) .'</div>';
            echo '</div><div class="clear"></div>';
        }?>
    </article>

    <!-- RIGHT HAND ASIDE -->
    <div class="grid_1">&nbsp;</div>
    <aside class="grid_3">
        <?php require_once 'blog_subnav.php'; ?>
    </aside>

    <div class="clear" style="height:10px;"></div>

</div> <!-- /container -->
