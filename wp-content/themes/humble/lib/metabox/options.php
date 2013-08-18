<?php
// Include & setup custom metabox and fields
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );
function be_sample_metaboxes( $meta_boxes ) {
	$prefix = '_hb_';
	
	$meta_boxes[] = array(
	    'id' => 'background_options',
	    'title' => 'Background options',
	    'pages' => array('post', 'page', 'portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	        array(
		        'name' => 'Color',
		        'desc' => '',
		        'id' => $prefix . 'bg_color',
		        'type' => 'color'
		    ),
	        array(
		        'name' => 'Image URL',
		        'desc' => 'Upload an image or enter an URL.',
		        'id' => $prefix . 'bg_image',
		        'type' => 'file'
		    ),
		    array(
		       'name' => 'Repeat',
		       'desc' => '',
		       'id' => $prefix . 'bg_repeat',
		       'type' => 'select',
				'options' => array(
					array('name' => 'No repeat', 'value' => 'no-repeat'),
					array('name' => 'Repeat Horizontally', 'value' => 'repeat-x'),
					array('name' => 'Repeat Vertically', 'value' => 'repeat-y'),				
					array('name' => 'Repeat all', 'value' => 'repeat'),				
				)
			),
			array(
		       'name' => 'Position',
		       'desc' => '',
		       'id' => $prefix . 'bg_position',
		       'type' => 'select',
				'options' => array(
					array('name' => 'Top left', 'value' => 'top left'),
					array('name' => 'Top center', 'value' => 'top center'),
					array('name' => 'Top right', 'value' => 'top right'),
					array('name' => 'Middle left', 'value' => 'center left'),
					array('name' => 'Middle center', 'value' => 'center center'),
					array('name' => 'Middle right', 'value' => 'center right'),
					array('name' => 'Bottom left', 'value' => 'bottom left'),
					array('name' => 'Bottom center', 'value' => 'bottom center'),
					array('name' => 'Bottom right', 'value' => 'bottom right'),
				)
			),
			array(
		       'name' => 'Attachment',
		       'desc' => '',
		       'id' => $prefix . 'bg_attachment',
		       'type' => 'select',
				'options' => array(
					array('name' => 'Fixed in place', 'value' => 'fixed'),
					array('name' => 'Scroll normally', 'value' => 'scroll'),
				)
			),
	    )
	);
	//Portfolio Template page
	$meta_boxes[] = array(
	    'id' => 'portfolio',
	    'title' => 'Portfolio settings',
	    'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	       array(
		        'name' => 'Portfolio columns',
		        'desc' => 'Only for Portfolio page template',
		        'id' => $prefix . 'portfolio_cols',
		        'type' => 'radio_inline',
				'options' => array(
					array('name' => '1', 'value' => '1'),
					array('name' => '2', 'value' => '2'),
					array('name' => '3', 'value' => '3'),
					array('name' => '4', 'value' => '4')
				)
		    ),
	    )
	);
	
	//Portfolio Post Type
	$meta_boxes[] = array(
	    'id' => 'portfolio',
	    'title' => 'Portfolio Item settings',
	    'pages' => array('portfolio'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
		    array(
		        'name' => 'Short Description',
		        'desc' => 'Fill this field if you are using 1 column portfolio template.',
		        'id' => $prefix . 'project_desc',
		        'type' => 'textarea',
		    )
	    )
	);
	
	//Slide Post type
	$meta_boxes[] = array(
	    'id' => 'slide',
	    'title' => 'Slide settings',
	    'pages' => array('slide'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
	    'fields' => array(
	    	array(
		        'name' => 'Image',
		        'desc' => 'Upload an image or enter an URL.',
		        'id' => $prefix . 'slide_image',
		        'type' => 'file'
		    ),
	       	array(
		        'name' => 'Link',
		        'desc' => '',
		        'id' => $prefix . 'slide_link',
		        'type' => 'text_medium',
		    ),
		    array(
		        'name' => 'Caption',
		        'desc' => '',
		        'id' => $prefix . 'slide_caption',
		        'type' => 'text_medium',
		    )
	    )
	);
	
	return $meta_boxes;
}

add_action('init','be_initialize_cmb_meta_boxes',9999);
function be_initialize_cmb_meta_boxes() {
    if (!class_exists('cmb_Meta_Box')) {
        require_once('init.php');
    }
}