<?php get_header(); ?>
<?php the_post(); ?>
<?php 
	$icon = get_post_meta( $post->ID, '_cmb_icon',true);
?>
	<article>

		<header>
			<h1><?php the_title(); ?></h1>
		</header>



		<?php include("templates/inc/featured_image.php"); ?>
		<div class="content">
			<div class="left-icon bph-icons"><?= '&#'.$icon.';' ?></div>

			<?php the_content(); ?>

		</div>

	</article>
<?php get_footer(); ?>
