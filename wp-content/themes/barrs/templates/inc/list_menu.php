<?php
  // Find connected posts
  $sections = new WP_Query( array(
    'connected_type' => 'menu_sections_to_pages',
    'connected_items' => get_queried_object(),
    'post_status' => 'publish',
    'nopaging' => true
  ) );


  // Display connected posts
  if ( $sections->have_posts() ) :
?>
  <div class="menu-nav-component">
    <div class="inner-wrapper">
<?php
     while ( $sections->have_posts() ) : $sections->the_post();
?>
    <a href="#<?= $post->post_name ?>"><?php the_title(); ?></a>

<?php
     endwhile; 
?>
</div>
</div>
<?php

     while ( $sections->have_posts() ) : $sections->the_post();
      $icon = get_post_meta( $post->ID, '_cmb_icon', true );

?>

  <section id="<?=$post->post_name?>" class="list-menu">

    <header>
      <h2><?php the_title(); ?></h2>
      <div class="bph-icons"><?= '&#'.$icon.';' ?></div>
    </header>
      <div class="content"><?php the_content(); ?></div>

      <ul class="menu-items">

<?php

     // Find connected posts
    $items = new WP_Query( array(
      'connected_type' => 'menu_items_to_menu_sections',
      'connected_items' => $post->ID,
      'post_status' => 'publish',
      'nopaging' => true
    ) );

    


    // Display connected posts
  if ( $items->have_posts() ) :

     while ( $items->have_posts() ) : $items->the_post(); 
   $price = get_post_meta( $post->ID, '_cmb_price', true );
   ?>
      <li class="menu-item">
        <h1><?php the_title(); ?><span><?= $price ?></span></h1>
        <div><?php the_content(); ?></div>
      </li>

<?php 

    endwhile;  
    // Prevent weirdness
    wp_reset_postdata();

  endif;
?>
</ul><!-- end menu-items -->
</section>
<?php
    endwhile;  
    // Prevent weirdness
    wp_reset_postdata();

  endif;

?>

