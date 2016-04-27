<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function custom_artists_sections() { 
	// creating (registering) the custom type 
	register_post_type( 'artists', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Artist', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Artist', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Artists', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Artist', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Artists', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Artist', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Artist', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Artists', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			
			'description' => __( 'Contains all artists', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => false,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'artists' ), /* you can specify it's url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this ads your post categories to your custom post type */
	//register_taxonomy_for_object_type('category', 'artists');
	/* this ads your post tags to your custom post type */
	//register_taxonomy_for_object_type('post_tag', 'artists');
	
} 

// adding the function to the Wordpress init
add_action( 'init', 'custom_artists_sections');


//Post 2 Post connections
function artists_connections() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'attachments_to_artists',
		'to' => 'artists',
		'from' => 'attachment',
		'admin_box' => 'to',
		'sortable' => 'to',
		'from_query_vars' => array( 'post_mime_type' =>'image' )
	) );

	p2p_register_connection_type( array(
        'name' => 'attachments_to_pages',
        'to' => 'page',
        'from' => 'attachment',
        'admin_box' => 'to',
        'sortable' => 'to',
        'from_query_vars' => array( 'post_mime_type' =>'image' )
    ) );
}

add_action( 'wp_loaded', 'artists_connections' );

//* Display p2p box on the association template *//
function restrict_p2p_page_display( $show, $ctype, $post ) {

    if ( 'attachments_to_pages' == $ctype->name ) {
        return ( isset($post->page_template) && ( 'templates/events.php' == $post->page_template) || !isset($post->page_template) );
    }

    return $show;
}

add_filter( 'p2p_admin_box_show', 'restrict_p2p_page_display', 10, 3 );

?>
