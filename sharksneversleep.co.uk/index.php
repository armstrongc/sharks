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
            <h2>Front End Web Developer</h2>
            <p>I'm a front end website developer, it's what i do. Sharks Never Sleep is a <a href="/blog/">web design and development blog</a> covering all aspects of my work.</p>
        </div>
    </div>

    <!-- CENTRE COLUMN COLUMN -->
    <div class="grid_4">
        <div class="content_padding">
            <h2>Snippets, Examples &amp; Tutorials</h2>
            <p>The posts on this site will cover and document a number of areas from <a href="/blog/css/">CSS</a>, <a href="/blog/javascript/">Javascript</a> and <a href="/blog/html/">HTML</a> to <a href="/blog/git/">GIT</a> and <a href="/blog/design/">websign design</a>.</p>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="grid_4">
        <div class="content_padding">
            <h2>Responsive Website Design</h2>
            <p>RWD is becoming a large part of any front end web developers workload. Hopefully I can make sense of some of the murkier areas.</p>
        </div>
    </div>

</article>

<?php require_once 'common/footer_start.php'; ?>

<!-- top panel image cycle -->
<script src="/js/plugin/responsivecycle/responsivecycle.js"></script>
<script src="/js/plugin/responsivecycle/home.responsivecycle.js"></script>

<?php require_once 'common/footer_end.php'; ?>