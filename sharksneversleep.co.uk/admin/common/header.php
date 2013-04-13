<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $site_name .' ' .$site_version ?></title>
	<meta name="description" content="">
	<meta name="author" content="Christian Armstrong">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="<?php echo $site_url ?>/css/bootstrap.min.css">
	<style>body { padding-top: 60px; padding-bottom: 40px; }</style>
	<link rel="stylesheet" href="<?php echo $site_url ?>/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<?php echo $site_url ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $site_url ?>/js/jquery-ui/css/ui-lightness/jquery-ui-1.8.20.custom.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700' rel='stylesheet' type='text/css'>
	<script src="<?php echo $site_url ?>/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
    
    <!-- Favicon and Apple Touch Icons -->
    <link rel="shortcut icon" href="/admin/img/icons/favicon.ico" />
    
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<div id="dialog"></div>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="<?php echo $site_url ?>/"><img src="<?php echo $site_url ?>/img/logo.png" height="30" width="230" alt="cms logo" /><?php //echo $site_version ?></a>
      <div class="nav-collapse">
        <ul class="nav">
          <!-- TOP NAVIGATION ITEMS -->
          <li<?php if($secondaryDir==""){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/">Home</a></li>
          <li<?php if($secondaryDir=="about"){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/about/">About</a></li>
          <li<?php if($secondaryDir=="help"){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/help/">Help</a></li>

        </ul>
        <?php if($_SESSION['admin_logged_in']){ ?>
        <p class="navbar-text pull-right">Logged in as <a href="<?php echo $site_url ?>/section/user_details/index.php?mode=edit&user_id=<?php echo $_SESSION['user_id']; ?>"><?php echo $_SESSION['user_display_name'] ?></a> | <a href="<?php echo $site_url ?>/login/logout.php">Logout</a></p>
        <?php } ?>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        
        <?php if($_SESSION['admin_logged_in']){ ?>
        
        <ul class="nav nav-list">
          <li class="nav-header">Website Content</li>
          <li<?php if($secondaryDir==''){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/">Home</a></li>
          
          <?php 
		  // CFCs
		  require_once ROOT .'/cfc/adminNavigation.php';
	
		  $dbobject = new adminNavigationObj;
		  
		  $dbobject->sql_where   = 'is_live=1';
		  $dbobject->sql_orderby = 'display_order';
		  // get data
		  $where = "";
		  $qnav = $dbobject->getData($where);
		  
		  foreach ($qnav as $row) {?>
		  
			<?php if(in_array($row['admin_nav_id'], $_SESSION['admin_access_list']) || ($_SESSION['admin_access_type_id']<=3 && $_SESSION['admin_access_type_id'] > 0)){ ?>
              <li<?php if($tertiaryDir==strtolower($row['directory'])){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/section/<?php echo $row['directory']?>" title="<?php echo $row['nav_item']?>"><?php echo $row['nav_item']?></a></li>
            <?php }?>
		  <?php }?>
          
          <?php if($_SESSION['admin_access_type_id']<=2){ ?>
            <li class="nav-header">Website Admin</li>
            <li<?php if($tertiaryDir=='user'){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/section/user/">User Management</a></li>
            <?php if($_SESSION['admin_access_type_id']==1){ ?>
              <li<?php if($tertiaryDir=='website'){?> class="active"<?php }?>><a href="<?php echo $site_url ?>/section/website/">Website Settings</a></li>
            <?php } ?>
          <?php } ?>
        </ul>
        
        <?php } else { ?>
        
        	You must login to use the CMS. If you cannot gain access, please contact the system administrator.
        
        <?php } ?>
        
      </div><!--/.well -->
    </div><!--/span-->
    <div class="span9">