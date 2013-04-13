<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php
        if(isset($inline_page_title)) $page_title = $inline_page_title;
        if(isset($inline_page_description)) $page_description = $inline_page_description;
        if(isset($inline_canonical)) $canonical = $inline_canonical;
        if(isset($inline_keywords)) $keywords = $inline_keywords;
        if(isset($inline_ogimage)) $ogimage = $inline_ogimage;
        if(isset($inline_ogtitle)) $ogtitle = $inline_ogtitle;
        ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $page_title ?></title>
        <?php if($page_description!=""){ ?><meta name="description" content="<?php echo $page_description ?>" />
        <?php } ?>
        <?php if($keywords!=""){ ?><meta name="keywords" content="<?php echo $keywords ?>">
        <?php } ?>
        <meta name="viewport" content="width=device-width">

        <!-- WEB FONTS -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>


        <!-- FAVICON & APPLE TOUCH ICONS -->
        <link rel="shortcut icon" href="/img/icons/favicon.ico" />
        <link rel="apple-touch-icon" href="/img/icons/apple-touch-icon-precomposed.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-touch-icon-72x72-precomposed.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-touch-icon-114x114-precomposed.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-touch-icon-144x144-precomposed.png" />

        <!-- FACEBOOK OPEN GRAPH -->
        <meta property="og:title" content="<?php echo $ogtitle ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php echo $canonical ?>" />
        <meta property="og:image" content="<?php echo $ogimage ?>" />
        <meta property="og:site_name" content="Sharks Never Sleep" />

        <!-- CANONICAL -->
        <?php if($canonical!="") {?><link rel="canonical" href="<?php echo $canonical ?>"/>
        <?php } ?>

        <!-- STRUCTURAL CSS -->
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="/css/main.css">

        <!-- GRID SYSTEM -->
        <link rel="stylesheet" href="/css/grid/grid_1200.css" media="only screen and (min-width : 1200px)">
        <link rel="stylesheet" href="/css/grid/grid_960.css" media="only screen and (min-width : 960px) and (max-width : 1199px)">
        <link rel="stylesheet" href="/css/grid/grid_768.css" media="only screen and (min-width : 768px) and (max-width : 959px)">
        <link rel="stylesheet" href="/css/grid/grid_600.css" media="only screen and (min-width : 600px) and (max-width : 767px)">
        <link rel="stylesheet" href="/css/grid/grid_480.css" media="only screen and (max-width : 599px)">

        <!-- RSS Feed -->
        <link rel="alternate" type="application/rss+xml" title="Sharks Never Sleep RSS Feed" href="http://feeds.feedburner.com/sharksneversleep" />

        <!-- DEFAULT/LAYOUT STYLES -->
        <link rel="stylesheet" href="/css/styles.css">
        <!-- INDIVIDUAL PAGE STYLES -->
        <link rel="stylesheet" href="/css/pages.css">

        <!-- MODERNIZR -->
        <script src="/js/vendor/modernizr-2.6.2.min.js"></script>