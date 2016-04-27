<?php
/*
Template Name: Featured Artist Template
*/
  
  $connections = new WP_Query( array(
    'post_type' => 'artists',
    'post_count' => 1,
    'post_status' => 'publish',
    'nopaging' => true,
    'orderby' => 'date',
    'order' => 'DESC'
  ) );

  header( 'Location: '.get_permalink($connections->posts[0]->ID) ) ;
?>
