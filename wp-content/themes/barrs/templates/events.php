<?php
/*
Template Name: Events Template
*/
?>

<?php get_header(); ?>
<?php the_post(); ?>

	<article>

		<header>
			<h1><?php the_title(); ?>.</h1>
		</header>

		<?php include("inc/list_event_images.php"); ?>
		<div class="content">
			<!--<div class="left-icon bph-icons"><?= '&#128197;' ?></div>-->
			<div class="left-icon bph-icons"><?= '&#57346;'?></div>
			<?php the_content(); ?>
		</div>

		<section>
			<header>
				<h2>Upcoming Events</h2>
			</header>
			<div class="content">
				<ul class="events-list events-component">
					<?php include("inc/list_events.php"); ?>
				</ul>
			</div>
		</section>
	</article>

	
<?php get_footer(); ?>
