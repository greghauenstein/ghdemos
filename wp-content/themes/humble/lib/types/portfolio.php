<?php
function register_portfolio_post_type(){

	$permalink_slug = trim(of_get_option('portfolio_slug', 'portfolio'));
	if (empty($permalink_slug) ) {
		$permalink_slug = 'portfolio';
	}
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => ucfirst($permalink_slug),
			'singular_name' => ucfirst($permalink_slug),
			'add_new' => 'Add New ',
			'add_new_item' => 'Add New Portfolio Item',
			'edit_item' => 'Edit Portfolio Item',
			'new_item' => 'New Portfolio Item',
			'view_item' => 'View Portfolio Item',
			'search_items' => 'Search Portfolio Items',
			'not_found' =>  'No portfolio item found',
			'not_found_in_trash' => 'No portfolio items found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Portfolio'
		),
		'singular_label' => 'portfolio',
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes'),
		'has_archive' => false,
		'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => true
	));
	
	add_rewrite_rule( 'portfolio/page/([0-9]+)/?$', 'index.php?pagename=portfolio&paged=$matches[1]', 'top' );
	flush_rewrite_rules();
	
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => 'Portfolio Categories',
			'singular_name' => 'Portfolio Category',
			'search_items' =>  'Search Categories',
			'popular_items' => 'Popular Categories',
			'all_items' => 'All Categories',
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => 'Edit Portfolio Category', 
			'update_item' => 'Update Portfolio Category',
			'add_new_item' => 'Add New Portfolio Category',
			'new_item_name' => 'New Portfolio Category Name',
			'separate_items_with_commas' => 'Separate Portfolio category with commas',
			'add_or_remove_items' => 'Add or remove portfolio category',
			'choose_from_most_used' => 'Choose from the most used portfolio category',
			'menu_name' => 'Categories',
		),
		'public' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'query_var' => false,
		'rewrite' => false,
		
	));
	
	
}
add_action('init','register_portfolio_post_type', 0);

function portfolio_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'portfolio' ) {
		global $wp_query;
		$wp_query->is_home = false;
	}
	if ( get_query_var( 'taxonomy' ) == 'portfolio_category' ) {
		global $wp_query;
		$wp_query->is_404 = false;
		$wp_query->is_tax = false;
		$wp_query->is_archive = true;
	}
}
add_action( 'template_redirect', 'portfolio_context_fixer' );

/*-----------------------------------------------*/
/* View portfolio
/*-----------------------------------------------*/
function edit_portfolio_columns($columns) {
	$columns['thumbnail'] = 'Thumbnail';
	$columns['portfolio_categories'] = 'Categories';
	unset($columns['comments']);
	$columns['comments'] = '<span class="vers"><img alt="Comments" src="'.get_bloginfo('url').'/wp-admin/images/comment-grey-bubble.png"></span>';
	unset($columns['date']);
	return $columns;
}
add_filter('manage_edit-portfolio_columns', 'edit_portfolio_columns', 10, 2);

function manage_portfolio_columns($column) {
	global $post;
	if ($post->post_type == "portfolio") {
		switch($column){
			case "portfolio_categories":
				$terms = get_the_terms($post->ID, 'portfolio_category');
				if (! empty($terms)) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=portfolio&portfolio_category=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio_category', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('portfolio_category');
					$output = "No $t->label";
				}
				echo $output;
				break;
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);