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
function custom_menu_sections() { 
	// creating (registering) the custom type 
	register_post_type( 'menu_sections', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Menu Sections', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Menu Section', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Menu Sections', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Menu Section', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Menu Sections', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Menu Section', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Menu Section', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Menu Sections', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Contains all menu sectionss', 'bonestheme' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => false,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'menu_sections', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'menu_sections', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this ads your post categories to your custom post type */
	//register_taxonomy_for_object_type('category', 'menu_sections');
	/* this ads your post tags to your custom post type */
	//register_taxonomy_for_object_type('post_tag', 'menu_sections');
	
} 


//Post 2 Post connections
function menu_sections_connections() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'menu_sections_to_pages',
		'from' => 'menu_sections',
		'to' => 'page',
		'admin_box' => 'to',
		'sortable' => 'to'
	) );
}

add_action( 'wp_loaded', 'menu_sections_connections' );

//* Display p2p box on the association template *//
function restrict_p2p_abox_display( $show, $ctype, $post ) {

	if ( 'menu_sections_to_pages' == $ctype->name ) {
		return ( isset($post->page_template) && ('templates/food-menu.php' == $post->page_template) || !isset($post->page_template) );
	}

	return $show;
}

add_filter( 'p2p_admin_box_show', 'restrict_p2p_abox_display', 10, 3 );

// adding the function to the Wordpress init
add_action( 'init', 'custom_menu_sections');?>
