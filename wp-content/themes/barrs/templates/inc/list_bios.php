<?php
  // Find connected posts
  $connections = new WP_Query( array(
    'connected_type' => 'bios_to_pages',
    'connected_to' => get_queried_object(),
    'post_status' => 'publish',
    'nopaging' => true,
  ) );

  // Display connected posts
  if ( $connections->have_posts() ) :
?>

<ul class="bios-list">

<?php

     while ( $connections->have_posts() ) : $connections->the_post(); 
?>
      <li>
        <?php include("bios_image.php"); ?>
        
          <h2><?php the_title(); ?></h2>
          <?php the_content(); ?>
          <div class="text">
            <?php bph_post_tags($post->ID); ?>
          </div>
      </li>

<?php 

    endwhile;  
    // Prevent weirdness
    wp_reset_postdata();
?>

</ul>

<?php

  endif;

?>

