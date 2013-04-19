

<div class="container_12 clearfix" role="main">

    <!-- BREADCRUMB -->
    <div class="grid_12">
        <nav class="blog_breadcrumb">
            <ul>
                <li><a href="/">Home</a></li>
                <li>&gt;</li>
                <li><a href="/<?php echo $blog_url ?>/">Articles</a></li>
                <li>&gt;</li>
                <li><a href="/<?php echo $blog_url ?>/<?php echo gen_filename($qcat[0]['category']) ?>/"><?php echo $qcat[0]['category']; ?></a></li>
                <li>&gt;</li>
                <li><a href="/<?php echo $blog_url ?>/<?php echo gen_filename($qcat[0]['category']) ?>/<?php echo gen_filename($qpost[0]['post_title']) ?>/"><?php echo $qpost[0]['post_title']; ?></a></li>
            </ul>
        </nav>
    </div>


    <!-- Blog Post -->
    <article class="grid_8">
        <header class="blog_post_header"><h2><?php echo $qpost[0]['post_title']; ?></h2></header>

        <div class="blog_post">
        <?php echo $qpost[0]['post_copy']; ?>
        </div>

        <footer class="blog_post_footer">
            By <?php echo $qauthor[0]['author_display_name']; ?><br />
            <?php echo date('l jS F Y',strtotime($qpost[0]['post_date'])); ?>
        </footer>

        <?php if($blog_comments_on) require_once 'comments.php' ?>

    </article>

    <div class="grid_1">&nbsp;</div>

    <!-- asside sub nav -->
    <aside class="grid_3">
        <?php require_once 'blog_subnav.php'; ?>
    </aside>


</div> <!-- /container -->