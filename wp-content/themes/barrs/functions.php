<?php
function my_custom_login_logo() {
    echo '<style type="text/css">
        .login h1 a { background-image:url('.get_bloginfo('stylesheet_directory').'/library/images/custom-login-logo.png) !important;}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');


/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
    - head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
    - custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/

require_once('post-types/menu-items.php');
require_once('post-types/menu-sections.php');
require_once('post-types/artists.php');
require_once('post-types/events.php');
require_once('post-types/bios.php');

/*
3. library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

//featured image size
add_image_size( 'bph-featured-image', 612);

//gallery thumbnail size
add_image_size( 'bph-gallery-thumbnail', 181 , 145, true );

//Bio thumbnail size
add_image_size( 'bph-bio-thumbnail', 180 );

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <?php 
			    /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ 
			    ?>
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!



function _bph_get_menu_items_by_category( $category ){

    // Find connected posts
    $menu_items = new WP_Query( array(
        'post_type' => 'menu_items',
        'category_name' => $atts['category'],
        'post_status' => 'publish',
        'nopaging' => true
    ) );

    $template = '';

    // Display connected posts
    if ( $menu_items->have_posts() ) :


        while ( $menu_items->have_posts() ) : $menu_items->the_post(); 
            
            $title = get_the_title();
            $content = get_the_content();

            $template .= '
                <h1>'.$title.'</h1>
                <div>'.$content.'</div>
            ';


        endwhile;
        // Prevent weirdness
        wp_reset_postdata();

    endif;

    return $template;

}

add_shortcode( 'menu_items', '_sc_menu_items' );

/**************************
~~~ Custom Meta Boxes ~~~
***************************/
add_filter( 'cmb_meta_boxes', '_metaboxes' );

function _metaboxes( array $meta_boxes ) {
    $prefix = '_cmb_';

    $icons = array(
        array( 'name' => 'None', 'value' => '32'),
        array( 'name' => 'Hamburger', 'value' => '57345'),
        array( 'name' => 'Calendar', 'value' => '57346'),
        array( 'name' => 'Cocktail Glass and Shaker', 'value' => '57347'),
        array( 'name' => 'Cake', 'value' => '57348'),
        array( 'name' => 'Sparkling Cocktail', 'value' => '57349'),
        array( 'name' => 'Cocktail', 'value' => '57350'),
        array( 'name' => 'Knife, Fork and Plate', 'value' => '57351'),
        array( 'name' => 'Wine Bottle and Glass', 'value' => '57352'),
        array( 'name' => 'Beer Mug', 'value' => '57353'),
        array( 'name' => 'Wine Glass', 'value' => '57360'),
        array( 'name' => 'Ladle', 'value' => '57361'),
        array( 'name' => 'Cheese', 'value' => '57362'),
        array( 'name' => 'Knife and Fork', 'value' => '57363'),
        array( 'name' => 'Cocktail with Lime', 'value' => '57364'),
        array( 'name' => 'Barrel', 'value' => '57365'),
        array( 'name' => 'Two Mugs', 'value' => '57366'),
        array( 'name' => 'Clock', 'value' => '57367'),
        array( 'name' => 'Clock Filled', 'value' => '57368'),
        array( 'name' => 'Mic', 'value' => '57369'),
        array( 'name' => 'Music Notes', 'value' => '57376'),
        array( 'name' => 'Beer Glass', 'value' => '57377'),
        array( 'name' => 'Beer Tap', 'value' => '57378'),
        array( 'name' => 'Magic Wand', 'value' => '57380'),
        array( 'name' => 'Person', 'value' => '57857'),
        array( 'name' => 'Tag', 'value' => '57858'),
        array( 'name' => 'Guitar', 'value' => '57381'),
        array( 'name' => 'Keyboard', 'value' => '57382')
    );

    //Select Icon Template
    $select_icon = array(
        'name'    => 'Select Icon',
        'desc'    => 'Symbol that is displayed next to the title.',
        'id'      => $prefix . 'icon',
        'type'    => 'select',
        'options' => $icons
    );

    //Featured Image Template
    $featured_image = array(
        'name' => 'Featured Image',
        'desc' => 'Upload an image or enter an URL.',
        'id'   => $prefix . 'featured_image',
        'type' => 'file',
    );

    //Price Template
    $price = array(
        'name' => 'Price',
        'desc' => 'Price is shown next to title.',
        'id'   => $prefix . 'price',
        'type' => 'text',
        //'std' => '/post-slug-here',
        //'taxonomy'    => 'bb_ctc_link'
    );


    //Menu Sections Meta Box
    $meta_boxes[] = array(
        'id'         => 'ms_metabox',
        'title'      => 'Meta Info',
        'pages'      => array('menu_sections'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            $select_icon,
            $featured_image
        )
    );

    //Menu Items Meta Box
    $meta_boxes[] = array(
        'id'         => 'mi_metabox',
        'title'      => 'Meta Info',
        'pages'      => array('menu_items'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            $price
        )
    );
    
    //Events Meta Box
    $meta_boxes[] = array(
        'id'         => 'events_metabox',
        'title'      => 'Meta Info',
        'pages'      => array('events'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            $select_icon,
            array(
                'name' => 'Date',
                'desc' => 'The event date',
                'id'   => $prefix . 'test_textdate_timestamp',
                'type' => 'text_date_timestamp',
            ),
        )
    );
    
    //Location Meta Box
    $meta_boxes[] = array(
        'id'         => 'loc_metabox',
        'title'      => 'Meta Info',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Address Line 1',
                'desc' => 'field description (optional)',
                'id'   => $prefix . 'address_line_1',
                'type' => 'text',
            ),
            array(
                'name' => 'Address Line 2',
                'desc' => 'field description (optional)',
                'id'   => $prefix . 'address_line_2',
                'type' => 'text',
            ),
            array(
                'name' => 'Hours Line 1',
                'desc' => 'field description (optional)',
                'id'   => $prefix . 'hours_line_1',
                'type' => 'text',
            ),
            array(
                'name' => 'Hours Line 2',
                'desc' => 'field description (optional)',
                'id'   => $prefix . 'hours_line_2',
                'type' => 'text',
            ),
            array(
                'name' => 'Map Link',
                'desc' => 'where you want your map to link',
                'id'   => $prefix . 'map_url',
                'type' => 'text'
            ),
            $select_icon
        )
    );

    //Bios Template Meta Boxes
    $meta_boxes[] = array(
        'id'         => 'bios_metabox',
        'title'      => 'Meta Info',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name'    => 'Select Icon One',
                'desc'    => 'Symbol that is displayed next to the title.',
                'id'      => $prefix . 'icon_one',
                'type'    => 'select',
                'options' => $icons
            ),

            array(
                'name' => 'Bios Title',
                'desc' => 'This is a title for the bios section.',
                'id'   => $prefix . 'bios_title',
                'type' => 'text',
            ),

            array(
                'name'    => 'Bios Content',
                'desc'    => 'Content that is before the bios.',
                'id'      => $prefix . 'bios_content',
                'type'    => 'wysiwyg',
                'options' => array( 'textarea_rows' => 5, ),
            ),

            array(
                'name'    => 'Select Icon Two',
                'desc'    => 'Symbol that is displayed next to the title.',
                'id'      => $prefix . 'icon_two',
                'type'    => 'select',
                'options' => $icons
            )
        )
    );

    return $meta_boxes;
}


add_filter( 'cmb_show_on', 'cmb_exclude', 10, 2 );


function cmb_exclude($display, $metabox){
    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : false);

    if(!$post_id){
        return false;
    }

    $template_file = get_post_meta($post_id,'_wp_page_template',TRUE);


    //Hide Metaboxes
    if($metabox['id'] == 'loc_metabox' && $template_file != 'templates/location.php'){
        return false;
    }
    
    //Hide Metaboxes
    if($metabox['id'] == 'bios_metabox' && $template_file != 'templates/bios.php'){
        return false;
    }

    return true;
}

function bph_post_tags($post_id,$args = array()){
    $tags = wp_get_post_tags( $post_id, $args );
    $return = '';
    foreach($tags as $tag){
        $return .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>, ';
    }
    return rtrim($return, " ,");
}


function bph_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if($pages != 1)
     {
         echo "<div class=\"pagination\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1) echo "<a class=\"prev\" href='".get_pagenum_link($paged - 1)."'><span>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages) echo "<a class=\"next\" href=\"".get_pagenum_link($paged + 1)."\"><span>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
 
    
add_action( 'pre_get_posts', '_artists_pre_get_posts', 1 );

function _artists_pre_get_posts($query){

    if($query->is_post_type_archive('artists') && !$query->is_admin){
        $query->set( 'posts_per_page', 9 );
        return;
    }
}

// Hides the update Wordpress nag
add_action('admin_menu','wphidenag');
function wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}

?>
