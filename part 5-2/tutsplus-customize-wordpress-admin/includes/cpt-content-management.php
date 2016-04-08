<?php
/*****************************************************************
Customizing the WordPress Admin - tutsplus course
File for using a cusotm post tyupe and taxonomy to output sidebars and banners etc. in the site
*****************************************************************/

/*****************************************************************
Register the custom post type
*****************************************************************/
function tutsplus_register_post_type() {
	
	$labels = array(
		'name' => __( 'Content Areas', 'tutsplus'),
		'singular_name' => __( 'Content Area', 'tutsplus'),
		'add_new' => __( 'New Content Area', 'tutsplus'),
		'add_new_item' => __( 'Add New Content Area', 'tutsplus'),
		'edit_item' => __( 'Edit Content Area', 'tutsplus'),
		'new_item' => __( 'New Content Area', 'tutsplus'),
		'view_item' => __( 'View Content Area', 'tutsplus'),
		'search_items' => __( 'Search Content Areas', 'tutsplus'),
		'not_found' => __( 'No Content Areas Found', 'tutsplus'),
		'not_found_in_trash' => __( 'No Content Areas Found in Trash', 'tutsplus'),
	);
	
	$args = array (
		'labels' => $labels,
		'has_archive' => false,
		'public' => true,
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'page-attributes'
		)	
	);
	
	register_post_type( 'contentarea', $args );	
	
}
add_action( 'init', 'tutsplus_register_post_type' );

/*****************************************************************
Register the custom taxonomy
*****************************************************************/
function tutsplus_register_taxonomy() {
	
	$labels = array(
		'name' => __( 'Locations', 'tutsplus' ),
		'singular_name' => __( 'Location', 'tutsplus' ),
		'search_items' => __( 'Search Locations', 'tutsplus' ),
		'all_items' => __( 'All Locations', 'tutsplus' ),
		'edit_item' => __( 'Edit Location', 'tutsplus' ),
		'update_item' => __( 'Update Location', 'tutsplus' ),
		'add_new_item' => __( 'Add New Location', 'tutsplus' ),
		'new_item_name' => __( 'New Location Name', 'tutsplus' ),
		'menu_name' => __( 'Locations' ),
	);
	
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'sort' => true,
		'show_admin_column' => true
	);
	
	register_taxonomy( 'location', 'contentarea', $args );
		
}
add_action( 'init', 'tutsplus_register_taxonomy' );

/*****************************************************************
Output content areas with the 'sidebar' value for location in the sidebar
Hooked to the tutsplus_sidebar action hook, which has been added to a child theme of twenty sixteen.
*****************************************************************/
function tutsplus_display_sidebars() {
	
	$args = array(
		'post_type' => 'contentarea',
		'location' => 'sidebar'
	);
	
	$query = new WP_Query( $args );
	
	if ( $query->have_posts() ) {
		
		echo '<aside class="sidebar widget-area">';
		
			while ( $query->have_posts() ) : $query->the_post();
			
			echo '<article class="widget contentarea">';
				echo '<h3 class="widget-title">' . get_the_title() . '</h3>';
				the_content();
			echo '</article>';
			
			endwhile;
		
		echo '</aside>';
		
		rewind_posts();	
		
	}
	
}
add_action( 'tutsplus_sidebar', 'tutsplus_display_sidebars' );