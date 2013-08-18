<?php
function register_slide_post_type(){

	$permalink_slug = 'slide';
	register_post_type('slide', array(
		'labels' => array(
			'name' => 'Slide',
			'singular_name' => 'Slide',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Slide Item',
			'edit_item' => 'Edit Slide Item',
			'new_item' => 'New Slide Item',
			'view_item' => 'View Silde Item',
			'search_items' => 'Search Slide Items',
			'not_found' =>  'No slide item found',
			'not_found_in_trash' => 'No slide items found in Trash',
			'parent_item_colon' => '',
			'menu_name' => 'Slides',
		),
		'singular_label' => 'slide',
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor','page-attributes'),
		'has_archive' => false,
		'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => true,
	));
	
	flush_rewrite_rules();
	
}

add_action('init','register_slide_post_type', 0);

function edit_slide_columns($columns) {
	$columns['thumbnail'] = 'Thumbnail';
	$columns['link'] = 'Link';
	$columns['caption'] = 'Caption';
	unset($columns['date']);
	unset($columns['comments']);
	return $columns;
}
add_filter('manage_edit-slide_columns', 'edit_slide_columns');

function manage_slide_columns($column) {
	global $post;
	if ($post->post_type == "slide") {
		switch($column){
			case 'thumbnail':
				$image = get_post_meta(get_the_ID(), '_hb_slide_image', false);
				$image = $image[0];
				echo '<img src="'.get_bloginfo('template_directory') .'/timthumb.php?src='.$image.'&h=90&w=200&zc=1&q=100" alt="" />';
				break;
			case 'link':
				echo get_post_meta(get_the_ID(), '_hb_slide_link', true);
				break;
			case 'caption':
				echo get_post_meta(get_the_ID(), '_hb_slide_caption', true);
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_slide_columns', 10, 2);