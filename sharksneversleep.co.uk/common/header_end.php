    </head>
    <body>

        <!-- HEADER -->
        <header id="siteHeader">

            <!-- LOGO, STRAPLINE AND SOCIAL CONTAINER -->
            <div class="container_12 clearfix">
                <div class="grid_12 logo_row clearfix">

                    <!-- LEFT COLUMN / LOGO AND STRAPLINE -->
                    <div class="grid_8 alpha">
                        <!-- LOGO -->
                        <a href="/"><img src="/img/logo/sharks-never-sleep-logo.png" width="100px" id="logo" /></a>
                        <!-- STRAPLINE -->
                        <hgroup>
                        <h1><a href="/">Sharks Never Sleep</a></h1>
                        <h2>Website Design &amp; Development</h2>
                        </hgroup>
                        <!-- <img src="img/layout/strapline.png" width="100px" id="strapline" /> -->
                    </div>

                    <!-- RIGHT COLUMN / SOCIAL NAVIGATION (NOT MOBILE) -->
                    <div class="grid_4 omega desktop">

                        <!-- SOCIAL NAVIGATION -->
                        <ul id="socialHeader">
                            <li><a href="http://pinterest.com/sharksneverpin" target="_blank" title="Pinterest"><img src="/img/icons/pinterest.png" /></a></li>
                            <li><a href="http://www.facebook.com/sharksneversleepdesign" target="_blank" title="Facebook"><img src="/img/icons/facebook.png"  /></a></li>
                            <li><a href="http://twitter.com/sharksNeverPost" target="_blank" title="Twitter"><img src="/img/icons/twitter.png" /></a></li>
                            <li><a href="/rss.xml" target="_blank" title="RSS"><img src="/img/icons/rss.png" /></a></li>
                            <li><a href="http://github.com/sharksneversleep" target="_blank" title="Git Hub"><img src="/img/icons/github.png" /></a></li>
                        </ul>

                    </div>

                </div>
            </div>

            <?php 
            $blog_cat_html = false;
            $blog_cat_css = true;
            $blog_cat_javascript = false;
            $blog_cat_design = false;
            $blog_cat_git = true;
            ?>

            <!-- NAVIGATION CONTAINER -->
            <div class="container_12 clearfix">
                <div class="grid_12">

                    <!-- menu toggle displayed on mobile view -->
                    <div id="menuToggle" class="mobile">Menu</div>

                    <!-- NAVIGATION -->
                    <nav id="topNavigation" role="navigation">
                        <ul class="clearfix">
                            <li><a href="/<?php echo $blog_url ?>/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==0){ ?> class="nav_link_on"<?php } ?>>Latest Posts</a></li>
                            <?php if($blog_cat_html) { ?><li><a href="/<?php echo $blog_url ?>/html/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==7){ ?> class="nav_link_on"<?php } ?>>HTML</a></li><?php } ?>
                            <?php if($blog_cat_css) { ?><li><a href="/<?php echo $blog_url ?>/css/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==3){ ?> class="nav_link_on"<?php } ?>>CSS</a></li><?php } ?>
                            <?php if($blog_cat_javascript) { ?><li><a href="/<?php echo $blog_url ?>/javascript/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==1){ ?> class="nav_link_on"<?php } ?>>Javascript</a></li><?php } ?>
                            <?php if($blog_cat_design) { ?><li><a href="/<?php echo $blog_url ?>/design/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==8){ ?> class="nav_link_on"<?php } ?>>Design</a></li><?php } ?>
                            <?php if($blog_cat_git) { ?> <li><a href="/<?php echo $blog_url ?>/git/"<?php if($primaryDir==$blog_url && isset($_GET['category_id']) && $_GET['category_id']==9){ ?> class="nav_link_on"<?php } ?>>GIT</a></li><?php } ?>
                        </ul>
                    </nav>

                </div>
            </div>

        </header>