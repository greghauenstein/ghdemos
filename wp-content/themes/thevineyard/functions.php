<?php

global $theme_name, $theme_options;
$theme_name = 'skeleton';
$theme_options = get_option($theme_name);
if ( ! isset( $content_width ) ) $content_width = 950;

// Default Main menu display if custom isn't defined
function rf_main_menu() {
	wp_page_menu("show_home=1");
}

add_theme_support('automatic-feed-links');

// Add font replacement
function font_replacement() { 
	get_template_part('includes/font-replacement');
}
add_action('wp_head', 'font_replacement');


// Force wordpress to use full image quality (no compression)
function jpeg_full_quality( $quality ) { 
	return 100;
}
add_filter( 'jpeg_quality', 'jpeg_full_quality' );


function rf_wp_link_pages( ) {
	wp_link_pages( $args );
}


function rf_paginate_links() {
	paginate_links();
}

add_action( 'init', 'create_product_taxonomy', 0 );

function create_product_taxonomy() 
{
  $labels = array(
    'name' => _x( 'Product Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Categories' ),
    'parent_item_colon' => __( 'Parent Categories:' ),
    'edit_item' => __( 'Edit Categories' ), 
    'update_item' => __( 'Update Categories' ),
    'add_new_item' => __( 'Add New Categories' ),
    'new_item_name' => __( 'New Categories Name' ),
    'menu_name' => __( 'Product Categories' ),
  ); 	

  register_taxonomy('product_categories',array('product'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product_categories' ),
  ));
  
 }

function addthis_widget() {
	global $theme_options;
	$share = "<div class='share section-box'>";
	$share .= "<h3>Tell your friends</h3>";
	$share .= '<div class="addthis_toolbox addthis_default_style ">';
	
	$i=0; 
	if($theme_options['cp_share_fb']) {
		$share .= '<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>';
		$i++;
	}
	if($theme_options['cp_share_twitter']) {
		$share .= '<a class="addthis_button_tweet"></a>';
		$i++;
	}
	if($theme_options['cp_share_google']) {
		$share .= '<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>';
		$i++;
	}
	$share .= '</div>';
	$share .= '<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4f08c61559784f77"></script>';
	$share .= '</div>';
	
	if ($i>0) {
		echo $share;
	}
}



// Custom post type for slider
function custom_post_type_slider() {
	global $theme_name;
	
	$labels = array(
	  'name' => __('Slides', $theme_name),
	  'singular_name' => __('Slide', $theme_name),
	  'add_new' => __('Add New', $theme_name),
	  'add_new_item' => __('Add New Slide', $theme_name),
	  'edit_item' => __('Edit Slide', $theme_name),
	  'new_item' => __('New Slide', $theme_name),
	  'view_item' => __('View Slide', $theme_name),
	  'search_items' => __('Search Slides', $theme_name),
	  'not_found' =>  __('No slides found', $theme_name),
	  'not_found_in_trash' => __('No slides found in Trash', $theme_name), 
	  'parent_item_colon' => '',
	  'menu_name' => 'Slides'
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'show_in_menu' => true, 
	  'query_var' => true,
	  'rewrite' => true,
	  /*'taxonomies' => array('category'),*/
	  'capability_type' => 'post',
	  'has_archive' => false, 
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','editor','thumbnail','custom-fields')
	); 
	register_post_type('slide',$args);
}
add_action('init', 'custom_post_type_slider');



// Custom post type for products
function custom_post_type_product() {
	global $theme_name;
	
	$labels = array(
	  'name' => __('Products', $theme_name),
	  'singular_name' => __('Product', $theme_name),
	  'add_new' => __('Add New', $theme_name),
	  'add_new_item' => __('Add New Product', $theme_name),
	  'edit_item' => __('Edit Product', $theme_name),
	  'new_item' => __('New Product', $theme_name),
	  'view_item' => __('View Product', $theme_name),
	  'search_items' => __('Search Products', $theme_name),
	  'not_found' =>  __('No products found', $theme_name),
	  'not_found_in_trash' => __('No products found in Trash', $theme_name), 
	  'parent_item_colon' => '',
	  'menu_name' => 'Products'
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'show_in_menu' => true, 
	  'query_var' => true,
	  'rewrite' => true,
	  'taxonomies' => array('product_cateogries', 'post_tag'),
	  'capability_type' => 'post',
	  'has_archive' => true, 
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','editor','thumbnail','custom-fields')
	); 
	register_post_type('product',$args);
}
add_action('init', 'custom_post_type_product');





add_filter( 'attachment_fields_to_edit', 'kc_additional_image_size_input_fields', 11, 2 );


function kc_get_additional_image_sizes() {
	$sizes = array();
	global $_wp_additional_image_sizes;
	if ( isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes) ) {
		$sizes = apply_filters( 'intermediate_image_sizes', $_wp_additional_image_sizes );
		$sizes = apply_filters( 'kc_get_additional_image_sizes', $_wp_additional_image_sizes );
	}

	return $sizes;
}
function kc_additional_image_size_input_fields( $fields, $post ) {
	if ( !isset($fields['image-size']['html']) || substr($post->post_mime_type, 0, 5) != 'image' )
		return $fields;

	$sizes = kc_get_additional_image_sizes();
	if ( !count($sizes) )
		return $fields;

	$items = array();
	foreach ( array_keys($sizes) as $size ) {
		$downsize = image_downsize( $post->ID, $size );
		$enabled = $downsize[3];
		$css_id = "image-size-{$s}-{$post->ID}";
		$label = apply_filters( 'kc_image_size_name', $size );
		
	
		

		$html  = "<div class='image-size-item'>\n";
		$html .= "\t<input type='radio' " . disabled( $enabled, false, false ) . "name='attachments[{$post->ID}][image-size]' id='{$css_id}' value='{$size}' />\n";
		$html .= "\t<label for='{$css_id}'>{$label}</label>\n";
		if ( $enabled )
			$html .= "\t<label for='{$css_id}' class='help'>" . sprintf( "(%d x %d)", $downsize[1], $downsize[2] ). "</label>\n";
		$html .= "</div>";

		$items[] = $html;
	}

	$items = join( "\n", $items );
	$fields['image-size']['html'] = "{$fields['image-size']['html']}\n{$items}";

	return $fields;
}


// Sidebar Position Classes
	
function get_sidebar_position_classes($removesidebar = false) {
	global $theme_options;
	
	if($removesidebar != 'yes') {
		if(!isset($theme_options['cp_sidebar_position']) OR empty($theme_options['cp_sidebar_position']) OR $theme_options['cp_sidebar_position'] == 'left') {
			$classes['sidebar'] = " column column3x1 first left";
			$classes['content'] = " column column3x2 last right";
		}
		else {
			$classes['sidebar'] = " column column3x1 last right";
			$classes['content'] = " column column3x2 first left";	
		}
	}
	
	return $classes;
}

// Custom media image sizes
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider-image', 950, 99999 ); // Single page products
	add_image_size( 'post-small', 194, 250 ); // Single page products
	add_image_size( 'post-normal', 395, 999999 );	
	add_image_size( 'post-medium', 549, 999999 );	
	add_image_size( 'gallery-nosb-2', 395, 395, true ); // Post featured image
	add_image_size( 'gallery-nosb-3', 241, 241, true ); // Post featured image
	add_image_size( 'gallery-nosb-4', 163, 163, true ); // Post featured image
	add_image_size( 'gallery-sb-2', 253, 253, true ); // Post featured image
	add_image_size( 'gallery-sb-3', 154, 154, true ); // Post featured image
	add_image_size( 'gallery-sb-4', 104, 104, true ); // Post featured image	
	


// Include the admin controlpanel
require_once(TEMPLATEPATH . '/backend/controlpanel.php');
$cpanel = new ControlPanel();
require_once(TEMPLATEPATH . '/backend/customfields.php');


// Register the wp3 menu
function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => 'Main menu',
			'footer-menu' => 'Footer menu'
		)
	);
}
add_action( 'init', 'register_menus' );



// Load frontend scripts
function script_loader() {
	if (!is_admin()) {
		wp_register_style('style-shortcodes', get_template_directory_uri().'/includes/shortcodes.css', array('style'));
		wp_enqueue_style('style-shortcodes');
		
		if (is_single()) {
			wp_enqueue_script('comment-reply');
		}
		
	
		wp_enqueue_script('jquery');
		
		wp_register_script( 'jquery-superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
		wp_enqueue_script('jquery-superfish');
		
		wp_register_script( 'jquery-slidesjs', get_template_directory_uri().'/js/slides.min.jquery.js', array('jquery'));
		wp_enqueue_script('jquery-slidesjs');
		
		wp_register_script( 'jquery-custom', get_template_directory_uri().'/js/jquery.custom.js', array('jquery'));
		wp_enqueue_script('jquery-custom');
		
	}
}
add_action('wp_enqueue_scripts', 'script_loader');

// Shortcodes
include_once('includes/shortcodes.php');

// Enable shortcodes in widgets and wrap widget content in div
add_filter('widget_text', 'do_shortcode');

get_template_part('includes/csscolor');

// Load backend scripts
function admin_script_loader() {
	wp_register_style('controlpanel', get_template_directory_uri().'/backend/controlpanel.css');
	wp_enqueue_style('controlpanel');

	global $pagenow;
	
	if( $pagenow == 'widgets.php' ) {
		wp_register_style('custom-tax-widget', get_template_directory_uri(). '/backend/css/custom-tax-widget.css');	
		wp_enqueue_style( 'custom-tax-widget' );
	}
		
	wp_enqueue_script('jquery-ui-core', array('jquery'));
	
	if ($_POST['page'] == $theme_name) {
		wp_register_style('mycolorpicker_style', get_template_directory_uri().'/backend/css/colorpicker.css');
		wp_enqueue_style('mycolorpicker_style');
		wp_register_script('mycolorpicker', get_template_directory_uri().'/backend/js/colorpicker.js', array('jquery-ui-core'));
		wp_enqueue_script('mycolorpicker');
		wp_register_script('mycolorpicker_eye', get_template_directory_uri().'/backend/js/eye.js', array('jquery-ui-core'));
		wp_enqueue_script('mycolorpicker_eye');
		wp_register_script('mycolorpicker_utils', get_template_directory_uri().'/backend/js/utils.js', array('jquery-ui-core'));
		wp_enqueue_script('mycolorpicker_utils');
		wp_register_script('mycolorpicker_layout', get_template_directory_uri().'/backend/js/layout.js?ver=1.0.2', array('jquery-ui-core'));
		wp_enqueue_script('mycolorpicker_layout');
		
		wp_register_script('controlpanel_js', get_template_directory_uri().'/backend/controlpanel.js', array('mycolorpicker'));
		wp_enqueue_script('controlpanel_js');
	}
	
	wp_register_script('upload', get_template_directory_uri().'/backend/upload.js', array('jquery'));
	wp_enqueue_script('upload');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'admin_script_loader');

function rf_get_sidebar($post_id = false, $default = false) {
	$sidebar = get_post_meta($post_id, "sidebar", true);
	
	if(isset($sidebar) AND !empty($sidebar)) {
		$sidebar = $sidebar;
	}
	else {
		if(isset($default) AND !empty($default)) {
			$sidebar = $default;
		}
		else {
			$sidebar = "Sidebar";
		}
	}
	
	return $sidebar;
}


// Register the sidebars
if ( function_exists('register_sidebar') ) {

	
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name' => 'Store Sidebar',
		'id' => 'storebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
	
	if (isset($theme_options['cp_sidebar_name[]'])) {
		foreach ($theme_options['cp_sidebar_name[]'] as $i=>$value) {
			if ($value) {
				$sidebar_title = $theme_options['cp_sidebar_name[]'][$i];
				
				$sidebar_id = strtolower($sidebar_title);
				$sidebar_id = str_replace(' ','-',$sidebar_id);

				register_sidebar(array(
					'name' => $sidebar_title,
					'id' => $sidebar_id,
					'before_widget' => '<div class="widget">',
					'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				));
			}
		}
	}	
	
}





function nicepagination($query = '') {
	global $paged;
	if(empty($query)) {
		global $wp_query;
		$query = $wp_query;	
	}
	
	
	// get the number of pages
	if ( !$max_page ) {  
	  	$max_page = $query->max_num_pages;
	}
	
	// if there's more then 1 page..
	if( $max_page > 1 ){
		if ( !$paged ) $paged = 1;
		
		echo '<ul class="pagination">';
		
		if ( $paged > 1 ) {
			echo '<li><a class="previous" href="' . get_pagenum_link($paged-1) . '"><span class="title">&laquo; previous</span></a></li>';
		}
		
		$dots1 = true;
		$dots2 = true;
		
		for ( $i=1; $i <= $max_page; $i++ ) {
			if (($i == 1 || $i == $max_page) || ($i > $paged-3 && $i < $paged+3)) {
				echo '<li><a  class="button yellow';
				if ( $i == $paged ) echo ' active';
				echo '"href="' . get_pagenum_link($i) . '"><span class="title">';
				echo $i;
				echo '</span></a></li>';
			} elseif ($dots1 && $i > 1 && $i < $paged-3 ) {
				echo '<li class="dots">...</li>';
				$dots1 = false;
			} elseif ($dots2 && $i < $max_page && $i > $paged+3 ) {
				echo '<li class="dots">...</li>';
				$dots2 = false;
			}
			
		}
		
		if ( $paged < $max_page ) {
			echo '<li><a class="next" href="' . get_pagenum_link($paged+1) . '"><span class="title">next &raquo</span></a></li>';
		}
		
		echo '</ul>';
	}
}




// Get the custom sidebar name
function get_custom_sidebar() {
	global $wp_query, $theme_options;
	$pageid = $wp_query->post->ID;
	
	$sidebar_id = get_post_meta($pageid, "sidebar", true);
	
	if (!$sidebar_id) {
		$sidebar_id = 'sidebar';
	} else {
		$sidebar_id = strtolower($sidebar_id);
		$sidebar_id = str_replace(' ','-',$sidebar_id);
	}
	
	return $sidebar_id;
}



// Sidebar position
function sidebar_pos() {
	global $theme_options, $post;
	
	if(is_single() OR is_page()) { 
	$sidebarpos = strtolower(get_post_meta($pageid, "sidebarpos", true));
	$removesidebar = get_post_meta($post->ID, "removesidebar", true);
	
	if($removesidebar == "yes") {
		$pos = 'no_sidebar';
	}
	else {
		if (($sidebarpos == 'left' || $sidebarpos == 'right') && !is_search()) {
			$theme_options['cp_sidebar_position'] = $sidebarpos;
		}
		
		if ($theme_options['cp_sidebar_position'] == 'left') {
			$pos = "sidebar_left";
		} 
		else { 
			$pos = "sidebar_right"; 
		}
	}	
	return $pos;
	}
	
	return "sidebar_left";
}



// Add google analytics
function add_google_analytics() { 
	global $theme_options;
	?>
    
	<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo $theme_options['cp_trackingcode']; ?>']);
        _gaq.push(['_trackPageview']);
        
        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    
    <?php
}
if (isset($theme_options['cp_trackingcode']) AND !empty($theme_options['cp_trackingcode'])) {
	add_action('wp_head', 'add_google_analytics');
}




include("backend/custom-tax-widget.php");
// Widgets
include_once('widgets/rf_contact_widget.php');
include_once('widgets/rf_fronttext_widget.php');
include_once('widgets/rf_latest_posts_widget.php');
include_once('widgets/rf_maps_widget.php');
include_once('widgets/rf_twitter_widget.php');



?>