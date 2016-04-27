<?php
  // Find connected posts
  $connections = new WP_Query( array(
    'post_type' => 'attachment',
    'connected_type' => 'attachments_to_artists',
    'connected_to' => get_queried_object(),
    'post_status' => 'inherit',
    'nopaging' => true,
  ) );

  // Display connected posts
  if ( $connections->have_posts() ) :
?>

<div class="slider-component">
  <ul class="image-list">

  <?php

       while ( $connections->have_posts() ) : $connections->the_post();
        $image = wp_get_attachment_image_src( $post->ID , 'bph-featured-image' );
  ?>
        <li><img width="<?=$image[1]?>" height="<?=$image[2]?>" src="<?php echo $image[0]; ?>"/></li>

  <?php 

      endwhile;  
      // Prevent weirdness
      wp_reset_postdata();
  ?>

  </ul>
  <div class="slider-controls">
    <a class="left bph-icons" href="#">&#57860;</a>
    <div class="bullets"></div>
    <a class="right bph-icons" href="#">&#57863;</a>
  </div>
</div>

<?php

  endif;

?>

