<?php get_header(); ?>
<?php the_post(); ?>

	<article>

		<header>
			<h1>Gallery.</h1>
		</header>

		<?php include("templates/inc/list_images.php"); ?>

		<div class="content">
			<div class="left-icon bph-icons">&#57346;</div>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>


		<?php 
			if($single) { 
		?>
			<div class="nextprev">

			<?php 

			if(get_adjacent_post(false, '', true)) { 

			?>

				<span class="prev"><?php previous_post_link('%link','<span class="bph-icons">&#57860;</span> <span class="text">Previous Artist</span>'); ?></span>

			<?php

			} else { 
			echo ' <span class="prev" ><span class="bph-icons">&nbsp;</span> <span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span> '; 

			}; 

			echo '<span class="all"><a href="/artists"><span class="bph-icons">&#57861;</span> <span class="text">All Artists</span></a></span>';

			if(get_adjacent_post(false, '', false)) { 

			?>

				<span class="next"><?php next_post_link('%link','<span class="text">Next Artist</span> <span class="bph-icons">&#57863;</span>'); ?> </span> 

			<?php

			} else { 
				echo ' <span class="next"><span class="text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <span class="bph-icons">&nbsp;</span></span> '; 
			}

			?>

			</div>
		<?php } ?>


	</article>
		
	
<?php get_footer(); ?>
