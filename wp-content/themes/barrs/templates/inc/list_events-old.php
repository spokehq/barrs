<?php
  // Find connected posts
  $sections = new WP_Query( array(
    'connected_type' => 'events_to_pages',
    'connected_items' => get_queried_object(),
    'post_status' => 'future', // Only events with a future publish date
    'nopaging' => true,
  ) );
  $main_url   = get_permalink();
  $isActive   = true;

  // Display connected posts
  if ( $sections->have_posts() ) :

     while ( $sections->have_posts() ) : $sections->the_post();
      $event_date = get_post_meta( $post->ID, '_cmb_test_textdate_timestamp', true );
      $icon = get_post_meta( $post->ID, '_cmb_icon', true);
      $icon = ($icon != ' ')?$icon:'32';
      $slug       = $post->post_name;
      $excerpt = get_the_content();
      $excerpt = esc_attr( strip_tags( stripslashes( $excerpt ) ) );
      $excerpt = wp_trim_words( $excerpt, $num_words = 55, $more = NULL );
?>
      <li id="<?= $slug ?>" class="list-event <?= ($isActive ? "active" : "") ?>">
        <div class="time"><span class="month"><?= date("M", (int)$event_date) ?></span><span class="day"><?= date("d", (int)$event_date) ?></span></div>
        <div class="bph-icons">&#<?= $icon ?>;</div>
        <h1><?php the_title(); ?></h1>
        <div class="content">
          <?php the_content(); ?>
        </div>

        <div class="addthis_toolbox addthis_default_style" 
          addthis:url="<?=$main_url?>#<?=$slug?>" 
          addthis:title="<?php the_title(); ?>"
          addthis:description="<?=$excerpt?>"
        >
          <a class="addthis_button_preferred_1"></a>
          <a class="addthis_button_preferred_2"></a>
          <a class="addthis_button_preferred_3"></a>
          <a class="addthis_button_preferred_4"></a>
          <a class="addthis_button_compact"></a>
          <a class="addthis_counter addthis_bubble_style"></a>
        </div>

      </li>
<?php 

    $isActive = false;
    endwhile;  
    // Prevent weirdness
    wp_reset_postdata();
  
  else:?>
  
  	<li class="list-event active">
        <h1>No events are currently scheduled.</h1>
	</li>
      
  <?php
  endif;

?>

