<?php
require_once 'common/config.php';
require_once 'common/header_start.php';
?>

<!-- top panel image cycle CSS -->
<link rel="stylesheet" href="/js/plugin/responsivecycle/responsivecycle.css">

<?php require_once 'common/header_end.php'; ?>

<!-- IMAGE BANNER -->
<div class="container_12 clearfix">
    <div class="grid_12" style="position:relative;">
        <ul class="rslides">
            <li><img src="img/layout/scrolling_image_1.jpg" width="100%" /></li>
            <!-- <li><img src="img/layout/scrolling_image_2.jpg" width="100%" /></li>
            <li><img src="img/layout/scrolling_image_3.jpg" width="100%" /></li> -->
        </ul>
    </div>
</div>

<!-- ARTICLE / MAIN BODY OF CONTENT -->
<article class="container_12 clearfix" role="main">

    <!-- LEFT COLUMN -->
    <div class="grid_4">
        <div class="content_padding">
            <h2>Sharks Never Sleep</h2>
            <p>Sharks Never Sleep is a <a href="/blog/">web design and development blog</a> full to the brim of dazzling thoughts on Website Development.</p>
        </div>
    </div>

    <!-- CENTRE COLUMN COLUMN -->
    <div class="grid_4">
        <div class="content_padding">
            <h2>Guides &amp; Tutorials</h2>
            <p>A whole host of tips, tricks and guides for front end website developers, including <a href="/blog/css/">CSS tutorials</a>, <a href="/blog/javascript/">Javascript tutorials</a>, <a href="/blog/html/">HTML tutorials</a> and <a href="/blog/git/">a guide to installing and getting started with GIT</a>.</p>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="grid_4">
        <div class="content_padding">
            <h2>Push Things Forward</h2>
            <p>Take advantage of the tools available to improve, innovate and excite on a daily basis. CSS3, HTML5, and Javascript are my tools, let's see what can be done with them.</p>
        </div>
    </div>

</article>

<?php require_once 'common/footer_start.php'; ?>

<!-- top panel image cycle -->
<script src="/js/plugin/responsivecycle/responsivecycle.js"></script>
<script src="/js/plugin/responsivecycle/home.responsivecycle.js"></script>

<?php require_once 'common/footer_end.php'; ?>