<?php
//$theme_options = get_option('perpetual');
if ( !class_exists('myCustomFields') ) {
	class myCustomFields {
		/**
		* @var  string  $prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $prefix = '';
		/**
		* @var  array  $customFields  Defines the custom fields available
		*/
		var $customFields =	array(
			array(
				"title"			=> "Sidebar options",
				"type"			=>	"header",
				"scope"			=>	array( "page", "post" ),
				"capability"	=> "edit_page"
			),
			array(
				"name"			=> "removesidebar",
				"title"			=> "Disable the Sidebar",
				"description"	=> "Disable the sidebar for this page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page", "post" ),
				"capability"	=> "edit_page"
			),
			array(
				"name"			=> "sidebar",
				"title"			=> "Use a custom sidebar",
				"description"	=> "Use a custom sidebar for this page",
				"options"		=> "Sidebar",
				"type"			=>	"sidebar",
				"scope"			=>	array( "page", "post" ),
				"capability"	=> "edit_page"
			),
			array(
				"name"			=> "sidebarpos",
				"title"			=> "Position of the sidebar",
				"description"	=> "The page specific position of the sidebar",
				"options"		=> "Global setting (in theme settings),Left,Right",
				"type"			=>	"dropdown",
				"scope"			=>	array( "page", "post" ),
				"capability"	=> "edit_page"
			),
			array(		
				"title"			=> "Store Page options",
				"type"			=>	"header",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_store.php'
			),
			array(
				"name"			=> "exclude-categories-store",
				"title"			=> "Categories to exclude",
				"description"	=> "The categories to exclude in this store",
				"type"			=> "categories",
				"taxonomy"		=> "product_categories",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_store.php'
			),
			array(
				"name"			=> "product_count",
				"title"			=> "Number of products per page",
				"description"	=> "The number of products listed on a page (default is 10)",
				"type"			=>	"text",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_store.php'
			),
			array(
				"title"			=> "Blog Page options",
				"type"			=>	"header",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_blog.php'
			),
			array(
				"name"			=> "exclude-categories-blog",
				"title"			=> "Categories to exclude",
				"description"	=> "The categories to exclude in this blog page",
				"type"			=>	"categories",
				"taxonomy"		=> "category",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_blog.php'
			),
			array(
				"title"			=> "Gallery Page options",
				"type"			=>	"header",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page", 
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "categories",
				"title"			=> "Categories for the Gallery view",
				"description"	=> "The categories to use for the Gallery view. Please don't use the same categories on multiple pages.",
				"type"			=>	"categories",
				"taxonomy"		=>	"category",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "columns",
				"title"			=> "Number of columns",
				"description"	=> "The number of columns on a row (horizontal) to display on the gallery page",
				"options"		=> "4,3,2",
				"type"			=>	"dropdown",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_page",
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "showimages",
				"title"			=> "Display images",
				"description"	=> "Show images on the gallery page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_post",
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "showtitle",
				"title"			=> "Display titles",
				"description"	=> "Show titles on the gallery page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_post",
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "showdate",
				"title"			=> "Display dates",
				"description"	=> "Show dates on the gallery page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page" ),
				'template'		=> 'page_gallery.php',
				"capability"	=> "edit_post"
			),
			array(
				"name"			=> "showtext",
				"title"			=> "Display content",
				"description"	=> "Show content on the gallery page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page" ),
				"capability"	=> "edit_post",
				'template'		=> 'page_gallery.php'
			),
			array(
				"name"			=> "showreadmore",
				"title"			=> "Display read more button",
				"description"	=> "Show read more buttons on the gallery page",
				"type"			=>	"checkbox",
				"scope"			=>	array( "page" ),
				'template'		=> 'page_gallery.php',
				"capability"	=> "edit_post"
			),
			array(
				"name"			=> "titlelocation",
				"title"			=> "Location of the Title",
				"description"	=> "Where the title should be positioned inside the slider",
				"options"		=> "Left,Right,Don't Display",
				"type"			=>	"dropdown",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_page",
			),
			array(
				"name"			=> "contentalign",
				"title"			=> "Content Alignment",
				"description"	=> "Where the content of the slider will be positioned",
				"options"		=> "Right,Left",
				"type"			=>	"dropdown",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_page",
			),
			array(
				"name"			=> "buttontext",
				"title"			=> "Button Text",
				"description"	=> "Text to show on the call to action button",
				"type"			=>	"text",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_page",
			),
			array(
				"name"			=> "buttonurl",
				"title"			=> "Button URL",
				"description"	=> "Link the call to action button points to",
				"type"			=>	"text",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_page",
			),
			
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function myCustomFields() { $this->__construct(); }
		/**
		* PHP 5 Constructor
		*/
		function __construct() {
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				remove_meta_box( 'postcustom', 'post', $context );
				remove_meta_box( 'postcustom', 'page', $context );
				//Use the line below instead of the line above for WP versions older than 2.9.1
				//remove_meta_box( 'pagecustomdiv', 'page', $context );
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				add_meta_box( 'my-custom-fields', 'Additional settings', array( &$this, 'displayCustomFields' ), 'page', 'normal', 'high' );
				add_meta_box( 'my-custom-fields', 'Additional settings', array( &$this, 'displayCustomFields' ), 'post', 'normal', 'high' );
				add_meta_box( 'my-custom-fields', 'Additional settings', array( &$this, 'displayCustomFields' ), 'slide', 'normal', 'high' );
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post, $theme_options;
			?>
			<div class="form-wrap">
				<?php
				wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
				$currentTemplate = get_post_meta($post->ID, "_wp_page_template", true);
	
				foreach ( $this->customFields as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ($post->post_type=="post" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ($post->post_type=="page" )
									$output = true;
								break;
							}
							case "slide": {
								// Output on any slide screen
								if ($post->post_type=="slide" )
									$output = true;
								break;
							}
						}
						if ( $output ) break;
					}
					
					// Check template 
					if(isset($customField["template"]) AND $customField["template"] != $currentTemplate) {
						$output = false;
					}
					
					if(isset($customField["template"]) AND $customField["template"] == "page_blog.php" AND $post->ID == get_option('page_for_posts')) {
						$output = true;
					}

					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
						<div class="form-field form-required">
							<?php
							switch ( $customField[ 'type' ] ) {
								case "header": {
									// Header
									echo '<div class="customfield_header">' . $customField[ 'title' ] . '</div>';
									break;
								}
								case "checkbox": {
									// Checkbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									break;
								}
								case "textarea": {
									// Text area
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									break;
								}
								case "text": {
									// Text
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '">';
									break;
								}								case "upload": {
									// Upload field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" class="upload_field" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									echo '<div><input class="upload_button" style="width:auto;" type="button" value="Browse" /></div>';
									break;
								}
								case "dropdown": {
									// Dropdown field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<select name="' . $this->prefix . $customField[ 'name' ] .'" id="' . $this->prefix . $customField[ 'name' ] .'">';
									$options = explode(',',$customField['options']);
									foreach ($options as $option) {
										$selected = '';
										if (get_post_meta($post->ID, $this->prefix.$customField['name'], true) == $option) {
											$selected = 'selected="selected"';
										}
										echo '<option '.$selected.' value="'.$option.'">'.$option.'</option>';
									}
									echo '</select>';
									break;
								}
								case "categories": {
									// Category list
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<div class="sortable-list" style="overflow:auto;width:280px;height:200px;border: 1px solid #DFDFDF;display:inline-block;">';
									$category_array = get_post_meta( $post->ID, $this->prefix . $customField['name'], true );
									$temp_array = array();
									if ($category_array) {
										$temp_array = explode(',',$category_array);
										foreach ($temp_array as $catid) {
											$cat = get_term($catid, 'category');
											if(!$cat) {
												$cat = get_term($catid, 'product_categories');
											}
											
											echo '<div class="sortable">';
											echo '<input type="checkbox" checked name="' . $this->prefix . $customField['name'] . '[]" id="' . $this->prefix . $customField['name'] . '" value="' . $catid .'" />' . $cat->name;
											echo '</div>';
										}
									}
								

										$categories = get_terms($customField[ 'taxonomy' ]);
									foreach ($categories as $cat) {
										if ($cat->category_parent == 0 && !in_array($cat->term_id, $temp_array)) {
											echo '<div class="sortable">';
											echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '[]" id="' . $this->prefix . $customField['name'] . '" value="' . $cat->term_id .'" />' . $cat->name;
											echo '</div>';
										}
									}
									echo '</div>';
									break;
								}
								case "sidebar": {
									// Dropdown field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<select name="' . $this->prefix . $customField[ 'name' ] .'" id="' . $this->prefix . $customField[ 'name' ] .'">';
									echo '<option '.$selected.' value="">Theme Default</option>';

									
									$current_sb = get_post_meta($post->ID, $this->prefix.$customField['name'], true);
									$defaults = array("Sidebar", "Store Sidebar");
									
									foreach($defaults as $sb) {
										$selected = ($sb == $current_sb) ? "selected='selected'" : '';
										echo '<option '.$selected.' value="'.$sb.'">'.$sb.'</option>';
									}
								
									if ($theme_options['cp_sidebar_name[]']) {
										foreach ($theme_options['cp_sidebar_name[]'] as $i=>$value) {
											if ($value) {
												$selected = '';
												$option = $theme_options['cp_sidebar_name[]'][$i];
												if ($current_sb == $option) {
													$selected = 'selected="selected"';
												}
												echo '<option '.$selected.' value="'.$option.'">'.$option.'</option>';
											}
										}
									}
									echo '</select>';
									break;
								}
								case "images": {
									// image list
                                    echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									
									echo '<div class="image_list" style="overflow:auto;width:100%;height:auto;padding:10px 0;margin:10px 0;border: 1px solid #DFDFDF;display:inline-block;">';
									$images = explode(',',get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ));
									foreach ($images as $image) {
										if ($image != '') {
											echo '<img style="height:50px;width:auto;display:inline-block;padding:5px;" src="'.$image.'" />';
										}
									}
									echo '</div>';
									
									echo '<input type="text" style="display:none;" name="' . $this->prefix . $customField[ 'name' ] . '" class="upload_field" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) . '" />';
									echo '<div><input class="upload_button_images" style="width:auto;" type="button" value="Add image" /></div>';
									break;
								}
								default: {
									// Plain text field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									break;
								}
							}
							?>
							<?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
						</div>
					<?php
					}
				} ?>
			</div>
			<?php
		}
		/**
		* Save the new Custom Fields values
		*/
		function saveCustomFields( $post_id, $post ) {
			if ( !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
				return;
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			if ( $post->post_type != 'page' && $post->post_type != 'post' && $post->post_type != 'slide' )
				return;
			foreach ( $this->customFields as $customField ) {
		
				if ( current_user_can( $customField['capability'], $post_id ) ) {
					if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim((is_array($_POST[$this->prefix.$customField['name']]) ? implode(",",$_POST[$this->prefix.$customField['name']]) : $_POST[$this->prefix.$customField['name']]))) {
						update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], (is_array($_POST[$this->prefix.$customField['name']]) ? implode(",",$_POST[$this->prefix.$customField['name']]) : $_POST[$this->prefix.$customField['name']]) );
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
					}
				}
			}
		}
	} // End Class
} // End if class exists statement
// Instantiate the class
if ( class_exists('myCustomFields') ) {
	$myCustomFields_var = new myCustomFields();
}



/*******************/
/*     Cart 66     */
/*******************/

add_action( 'add_meta_boxes', 'cp_product' );
add_action( 'save_post', 'cp_product_save' );

function cp_product() {
    add_meta_box( 
        'cp_product', 
        'Cart 66 Product',
        'cp_product_box',
        'product',
        'side',
        'high'
    );
}

function cp_product_box( $post ) {
	global $wpdb;
	wp_nonce_field( plugin_basename( __FILE__ ), 'cp_product_nonce' );
	$products = $wpdb->get_results("SELECT id, name, item_number FROM ".$wpdb->prefix."cart66_products ORDER BY name ASC");
	$item_number = get_post_meta($post->ID, 'item_id', true);
?>
	<label>Select a product</label> <br>
	<select name='item_id' >
		<option value=''> -- No Product Selected -- </option>
		<?php 
			foreach ($products as $product) :
			$selected = ($product->id == $item_number) ? "selected='selected'" : ''; 
		?>
			<option <?php echo $selected ?> value='<?php echo $product->id ?>'><?php echo $product->name ?> (<?php echo $product->item_number ?>)</option>
		<?php endforeach ?>
	</select>


	<p class='howto'>
		If you would like to show an add to cart button automatically when this post is displayed, select a product
	</p>

<?php
}

function cp_product_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( !wp_verify_nonce( $_POST['cp_product_nonce'], plugin_basename( __FILE__ ) ) )
      return;

  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  

	update_post_meta($post_id, 'item_id', $_POST['item_id']);

}


?>