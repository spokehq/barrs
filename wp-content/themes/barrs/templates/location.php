<?php
/*
Template Name: Location Template
*/
?>

<?php get_header(); ?>
<?php the_post(); ?>
<?php


	$address_line_1 = get_post_meta( $post->ID, '_cmb_address_line_1', true );
	$address_line_2 = get_post_meta( $post->ID, '_cmb_address_line_2', true );
	$hours_line_1 = get_post_meta( $post->ID, '_cmb_hours_line_1', true );
	$hours_line_2 = get_post_meta( $post->ID, '_cmb_hours_line_2', true );
	$map_url = get_post_meta( $post->ID, '_cmb_map_url', true );
	$icon = get_post_meta( $post->ID, '_cmb_icon',true);



 ?>
	<article>
		<header>
			<h1><?php the_title(); ?>.</h1>
		</header>

		<div class="map">
			<div class="address">

				<h3>Barr's Public House</h3>

				
				
				<div class="location">
					<div class="bph-icons">&#57365;</div>
					<h4>Location</h4>
					<a href="<?= $map_url ?>">
						<div><?= $address_line_1 ?></div>
						<div><?= $address_line_2 ?></div>
					</a>
				</div>

				
				
				<div class="hours">
					<div class="bph-icons">&#57368;</div>
					<h4>Hours</h4>
					<div><?= $hours_line_1 ?></div>
					<div><?= $hours_line_2 ?></div>
				</div>
			</div>
			<?php include("inc/featured_image.php"); ?>
		</div>
		
		<div class="content">
			<div class="left-icon bph-icons"><?= '&#'.$icon.';' ?></div>
			<?php the_content(); ?>
		</div>
		
	</article>
<?php get_footer(); ?>
