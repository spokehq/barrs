<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php wp_title(''); ?></title>
		
		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  		<link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
  		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/library/css/ie-9-and-down.css" />
		<![endif]-->
  		<script type="text/javascript" src="//use.typekit.net/vfi1wks.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
			
		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
	</head>
	
	<body <?php body_class(array("background-component")); ?> >
	
		<div id="container">
			
			<div id="left-column">

				<header class="header" role="banner">
				
					<div id="inner-header" class="wrap clearfix">
						
						<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
						<p id="logo" class="h1">
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<img src="<?php bloginfo('template_directory'); ?>/library/images/tilted_barrs_logo.gif"/>
								<span class="name"><?php bloginfo('name'); ?></span>
							</a>
						</p>
						
						<!-- if you'd like to use the site description you can un-comment it below -->
						<?php // bloginfo('description'); ?>
						
						
						<nav role="navigation">
							<?php bones_main_nav(); ?>
						</nav>
					
					</div> <!-- end #inner-header -->
				
				</header> <!-- end header -->
			</div> <!-- end left column -->
			<div id="right-column">
				<div id="wrapper">
