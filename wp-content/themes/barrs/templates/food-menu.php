<?php
/*
Template Name: Food Menu Template
*/
?>

<?php get_header(); ?>

<?php if( get_field('menu_pdf') ): ?>
 
	<div id="menu-topbar">

		<span><?php the_field('menu_bar_message'); ?></span>
		<a href="<?php the_field('menu_pdf'); ?>">Download PDF</a>
 
	</div>
 
<?php endif; ?>	

<!--
<div id="menu-topbar">
	<span>Looking for our full menu?</span>
	<a href="http://barrs.spokeapps.net/wp-content/uploads/2014/05/Barrs_Menu_5-2014.pdf">Download PDF</a>
</div>
-->

<?php the_post(); ?>
	<article>

		<header>
			<h1><?php the_title(); ?>.</h1>
		</header>

		<?php include("inc/featured_image.php"); ?>
    <div class="content">
		  <?php the_content(); ?>
    </div>

		<?php include("inc/list_menu.php"); ?>

	</article>
<?php get_footer(); ?>
