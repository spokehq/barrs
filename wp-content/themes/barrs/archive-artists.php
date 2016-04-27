<?php get_header(); ?>

	<article>
		<header>
			<h1>Gallery.</h1>
		</header>

		<h2> All Artists </h2>

		<ul class="image-grid">


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	        
		        <?php

		        	$title = get_the_title();
		        	$link = get_permalink();

					// Find connected posts
					$connections = new WP_Query( array(
						'post_type' => 'attachment',
						'connected_type' => 'attachments_to_artists',
						'connected_to' => $post,
						'post_status' => 'inherit',
						'posts_per_page' => 1,
						'nopaging' => true,
					) );

					// Display connected posts
					if ( $connections->have_posts() ) : $connections->the_post(); 


					 $image = wp_get_attachment_image_src( $post->ID , 'bph-gallery-thumbnail' );


				?>
				
				<li>
					<a href="<?php echo $link; ?>">
					  <img src="<?php echo $image[0]; ?>"/>
					</a>
					<h3><?php echo $title; ?></h3>
				</li>


				<?php 
					// Prevent weirdness
					wp_reset_postdata();

					endif;

				?>
			

	<?php 

	    endwhile; 

	    // Prevent weirdness
	    wp_reset_postdata();

	  endif;

	?>
</ul>
	
<nav class="wp-prev-next">
    <ul class="clearfix">
        <li class="prev-link"><?php previous_posts_link(__('<span class="bph-icons">&#57859;</span> Older Entries', "bonestheme")) ?></li>
        <li class="home-link"><a href="#"><span class="bph-icons">&#57861;</span> <span>Current Artist</span></a></li>
        <li class="next-link"><?php next_posts_link(__('Newer Entries <span class="bph-icons">&#57862;</span>', "bonestheme")) ?></li>
    </ul>
</nav>

</section>


 </article>
<?php get_footer(); ?>
