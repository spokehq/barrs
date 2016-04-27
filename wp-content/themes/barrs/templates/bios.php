<?php
/*
Template Name: Bios Template
*/
?>

<?php get_header(); ?>
<?php the_post(); ?>

<?php


	$icon_one = get_post_meta( $post->ID, '_cmb_icon_one', true );
	$bios_title = get_post_meta( $post->ID, '_cmb_bios_title', true );
	$bios_content = get_post_meta( $post->ID, '_cmb_bios_content', true );
	$icon_two = get_post_meta( $post->ID, '_cmb_icon_two', true );

 ?>
	<article>

		<header>
			<h1><?php the_title(); ?>.</h1>
		</header>

		<?php include("inc/featured_image.php"); ?>
		
		<div class="content">
			<div class="left-icon bph-icons"><?= '&#'.$icon_one.';' ?></div>
			<?php the_content(); ?>

		</div>

		<section>
			<header>
				<h2><?= $bios_title ?></h2>
			</header>
			<div class="content">
				<div class="left-icon bph-icons"><?= '&#'.$icon_two.';' ?></div>
				<?= $bios_content ?>
				<?php include("inc/list_bios.php"); ?>
			</div>
		</section>

	</article>
<?php get_footer(); ?>




