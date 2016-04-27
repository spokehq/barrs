<?php

    $Path = $_SERVER['REQUEST_URI'];
    $main_url = get_site_url().$Path;
  
  // Display connected posts
  if ( have_posts() ) :

    while ( have_posts() ) : the_post();
      $slug       = $post->post_name;
      $post_tags = bph_post_tags($post->ID);
      $excerpt = get_the_content();
      $excerpt = esc_attr( strip_tags( stripslashes( $excerpt ) ) );
      $excerpt = wp_trim_words( $excerpt, $num_words = 55, $more = NULL );
?>
    <article id="<?=$slug?>">
        <header class="article-header">
            <h2><a href="#<?=$slug?>"><?php the_title(); ?></a></h2>
            <div class="time"><span><?php the_time('F d, Y') ?></span></div>
        </header>
        <div class="content">
            <div class="wp-content"><?php the_content(); ?></div>
            <div class="divider"></div>
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

            <div class="author-tags">
                <span class="author"><span class="bph-icons">&#57857;</span><?php the_author(); ?></span>
                <?php if($post_tags != ''){ ?>
                <span class="tags"><span class="bph-icons">&#57858;</span><?= $post_tags ?></span>
                <?php } ?>

            </div>
        </div>
    </article>

<?php 

    endwhile; 

    //bph_pagination($max_num_pages,1);

    ?>



    <?php

    // Prevent weirdness
    //wp_reset_postdata();

  endif;

?>

