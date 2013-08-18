<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	//Number
	$array_integer = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20");
	$array_float = array("0.1" => "0.1", "0.2" => "0.2", "0.3" => "0.3", "0.4" => "0.4", "0.5" => "0.5", "0.6" => "0.6", "0.7" => "0.7", "0.8" => "0.8", "0.9" => "0.9", "1" => "1");
	
	//Ms array
	$ms_array = array("100" => "100", "200" => "200", "300" => "300", "400" => "400", "500" => "500", "600" => "600", "700" => "700", "800" => "800", "900" => "900");
	
	$ms_array_2 = array("1000" => "1000", "2000" => "2000", "3000" => "3000", "4000" => "4000", "5000" => "5000", "6000" => "6000", "7000" => "7000", "8000" => "8000", "9000" => "9000", "10000" => "10000");
	
	//PX
	$array_px = array('14px' => '14px', '15px' => '15px', '16px' => '16px', '17px' => '17px', '18px' => '18px', '19px' => '19px', '20px' => '20px', '21px' => '21px', '22px' => '22px', '23px' => '23px', '24px' => '24px', '25px' => '25px', '26px' => '26px', '27px' => '27px', '28px' => '28px', '29px' => '29px', '30px' => '30px', '31px' => '31px', '32px' => '32px', '33px' => '33px', '34px' => '34px', '35px' => '35px', '36px' => '36px', '37px' => '37px', '38px' => '38px', '39px' => '39px', '40px' => '40px', '41px' => '41px', '42px' => '42px', '43px' => '43px', '44px' => '44px', '45px' => '45px', '46px' => '46px', '47px' => '47px', '48px' => '48px', '49px' => '49px', '50px' => '50px',);
	
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
	
	$fontpreviewpath = get_bloginfo('stylesheet_directory') . '/font/preview/';
	
	$texturepath =  get_bloginfo('stylesheet_directory') . '/images/textures/preview-';
		
	$options = array();
	
	/*-----------------------------------------------*/
	/* General Settings
	/*-----------------------------------------------*/
	$options[] = array( "name" => "General Settings",
						"type" => "heading");
						
	$options[] = array( "name" =>  "Logo",
						"desc" => "",
						"id" => "logo",
						"std" => get_bloginfo('template_directory') . '/images/logo.png', 
						"type" => "upload");
						
	$options[] = array( "name" => "",
						"desc" => "Logo position",
						"id" => "logo_position",
						"std" => "left",
						"type" => "select",
						"class" => "mini",
						"options" => array('left' => 'Right', 'right' => 'Left'));
						
	$options[] = array( "name" =>  "Background settings",
						"desc" => "This settings will be used by default except if you give your page or post another background setting in their metabox.",
						"id" => "background",
						"std" => $background_defaults, 
						"type" => "background");
	
						
	$options[] = array( "name" => "Homepage slogan",
						"desc" => "This is the H1 tag on the left on the slider. To write in red, use the span tag.",
						"id" => "slogan_h1",
						"std" => "WE’D LOVE<br />\nTO WORK WITH<br />\nYOU ON YOUR<br />\nNEXT PROJECT<span>.</span>",
						"type" => "textarea");
						
	$options[] = array( "name" => "",
						"desc" => "And this is the H2 tag",
						"id" => "slogan_h2",
						"std" => "SO WHY NOT<br />\nCOME AND CHAT<br />\nWITH US?",
						"type" => "textarea");
						
	$options[] = array( "name" => "Breadcrumb",
						"desc" => "Check to show the breadcrumb",
						"id" => "breadcrumb",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Post meta",
						"desc" => "Show date meta on a post or category listing",
						"id" => "meta_date",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "",
						"desc" => "Show author meta on a post or category listing",
						"id" => "meta_author",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "404 error message",
						"desc" => "",
						"id" => "404_message",
						"std" => "WTF? GOT LOST?",
						"type" => "text");
						
	$options[] = array( "name" => "Google analytics code",
						"desc" => "",
						"id" => "google_analytics",
						"std" => "",
						"type" => "textarea");
	
	/*-----------------------------------------------*/
	/* CSS
	/*-----------------------------------------------*/
	$options[] = array( "name" => "CSS",
						"type" => "heading");
						
	$options[] = array( "name" => "Typography",
						"desc" => "",
						"id" => "css_typography",
						"std" => array('size' => '12px','face' => 'arial','style' => 'normal','color' => '#666'),
						"type" => "typography");

	$options[] = array( "name" => "",
						"desc" => "Link color in post and page",
						"id" => "css_link",
						"std" => "#ff3131",
						"type" => "color");
	
	$options[] = array( "name" => "",
						"desc" => "Link hover from all hover the site (widget, title, meta…)",
						"id" => "css_hover",
						"std" => "#ff3131",
						"type" => "color");
						
	$options[] = array( "name" => "",
						"desc" => "H1 font size",
						"id" => "css_h1",
						"std" => "34px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
						
	$options[] = array( "name" => "",
						"desc" => "H2 font size",
						"id" => "css_h2",
						"std" => "30px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
	
	$options[] = array( "name" => "",
						"desc" => "H3 font size",
						"id" => "css_h3",
						"std" => "26px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
						
	$options[] = array( "name" => "",
						"desc" => "H4 font size",
						"id" => "css_h4",
						"std" => "20px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
						
	$options[] = array( "name" => "",
						"desc" => "H5 font size",
						"id" => "css_h5",
						"std" => "18px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
						
	$options[] = array( "name" => "",
						"desc" => "H6 font size",
						"id" => "css_h6",
						"std" => "14px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
	
	$options[] = array( "name" => "Menu active color",
						"desc" => "Color when the menu is active",
						"id" => "css_menu_active",
						"std" => "#ff3131",
						"type" => "color");
						
	$options[] = array( "name" => "Container opacity",
						"desc" => "This is the opacity of your background content (The white one)",
						"id" => "css_content_opacity",
						"std" => "0.2",
						"type" => "select",
						"class" => "mini",
						"options" => $array_float);
	
	$options[] = array( "name" => "Tag line configuration",
						"desc" => "H1 font size",
						"id" => "css_slogan_h1_font_size",
						"std" => "34px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
	
	$options[] = array( "name" => "",
						"desc" => "H2 font size",
						"id" => "css_slogan_h2_font_size",
						"std" => "20px",
						"type" => "select",
						"class" => "mini",
						"options" => $array_px);
						
	/*-----------------------------------------------*/
	/* Fonts
	/*-----------------------------------------------*/
	
	$options[] = array( "name" => "Font",
						"type" => "heading");
						
	$options[] = array( "name" => "Menu and header font",
						"desc" => "",
						"id" => "font",
						"std" => "CartoGothicStd",
						"type" => "images",
						"options" => array(
							'CartoGothicStd' => $fontpreviewpath . 'CartoGothic.png',
							'WinterthurCondensed' => $fontpreviewpath . 'WinterthurCondensed.png',
							'KomikaText' => $fontpreviewpath . 'KomikaText.png',
							'CicleGordita' => $fontpreviewpath . 'CicleGordita.png'
							)
						);
	
	/*-----------------------------------------------*/
	/* Images
	/*-----------------------------------------------*/
	
	$options[] = array( "name" => "Images size",
						"type" => "heading");
	
	$options[] = array( "name" => "Default size",
						"desc" => "The default size used by [image] shortcode",
						"id" => "image_default_size",
						"std" => "small",
						"type" => "select",
						"class" => "mini",
						"options" => array("small" => "Small", "medium" => "Medium", "large" => "Large"));
	
	$options[] = array( "name" => "Small Image Size",
						"desc" => "width in pixel for [image size=\"small\"] shortcode",
						"id" => "image_small_width",
						"std" => "200",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "",
						"desc" => "height in pixel for [image size=\"small\"] shortcode",
						"id" => "image_small_height",
						"std" => "150",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Medium Image Size",
						"desc" => "width in pixel for [image size=\"medium\"] shortcode",
						"id" => "image_medium_width",
						"std" => "350",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "",
						"desc" => "height in pixel for [image size=\"medium\"] shortcode",
						"id" => "image_medium_height",
						"std" => "250",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Large Image Size",
						"desc" => "width in pixel for [image size=\"large\"] shortcode",
						"id" => "image_large_width",
						"std" => "600",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "",
						"desc" => "height in pixel for [image size=\"large\"] shortcode",
						"id" => "image_large_height",
						"std" => "",
						"class" => "mini",
						"type" => "text");
						
	$options[] = array( "name" => "Lightbox option (see http://fancybox.net/api for detail)",
						"desc" => "Transition in",
						"id" => "lightbox_transition_in",
						"std" => "fade",
						"type" => "select",
						"class" => "mini",
						"options" => array("fade" => "Fade", "elastic" => "Elastic", "none" => "None"));
						
	$options[] = array( "name" => "",
						"desc" => "Transition out",
						"id" => "lightbox_transition_out",
						"std" => "elastic",
						"type" => "select",
						"class" => "mini",
						"options" => array("fade" => "Fade", "elastic" => "Elastic", "none" => "None"));
	
	$options[] = array( "name" => "",
						"desc" => "Speed in",
						"id" => "lightbox_speed_in",
						"std" => "500",
						"type" => "select",
						"class" => "mini",
						"options" => $ms_array);
						
	$options[] = array( "name" => "",
						"desc" => "Speed out",
						"id" => "lightbox_speed_out",
						"std" => "200",
						"type" => "select",
						"class" => "mini",
						"options" => $ms_array);
						
	$options[] = array( "name" => "",
						"desc" => "Caption position",
						"id" => "lightbox_caption_position",
						"std" => "over",
						"type" => "select",
						"class" => "mini",
						"options" => array("outside" => "Outside", "inside" => "Inside", "over" => "Over"));
						
	$options[] = array( "name" => "",
						"desc" => "Show close button",
						"id" => "lightbox_close_button",
						"std" => "true",
						"type" => "select",
						"class" => "mini",
						"options" => array("true" => "Yes", "false" => "No"));
						
	$options[] = array( "name" => "",
						"desc" => "Show navigation arrows",
						"id" => "lightbox_nav_arrows",
						"std" => "true",
						"type" => "select",
						"class" => "mini",
						"options" => array("true" => "Yes", "false" => "No"));
						
	/*-----------------------------------------------*/
	/* Sliders
	/*-----------------------------------------------*/
						
	$options[] = array( "name" => "Slider",
						"type" => "heading");
	
	$options[] = array( "name" => "Select the slider to use",
						"desc" => "Don't forget to configure your slider settings below",
						"id" => "slider",
						"std" => "nivo_slider",
						"type" => "select",
						"class" => "mini",
						"options" => array("nivo_slider" => "Nivo Slider", "polaroid" => "Polaroid (Custom)"));
						
	$options[] = array( "name" => "Nivo Slider Settings",
						"desc" => "Transition effect",
						"id" => "nivo_effect",
						"std" => "random",
						"type" => "select",
						"class" => "mini",
						"options" => array("random" => "random", "slideDown" => "slideDown", "slideDownLeft" => "slideDownLeft", "slideUp" => "slideUp", "sliceUpLeft" => "sliceUpLeft", "sliceUpDown" => "sliceUpDown", "sliceUpDownLeft" => "sliceUpDownLeft", "fold" => "fold", "fade" => "fade", "slideInRight" => "slideInRight", "slideInLeft" => "slideInLeft", "boxRandom" => "boxRandom", "boxRain" => "boxRain", "boxRainReverse" => "boxRainReverse", "boxRainGrow" => "boxRainGrow", "boxRainGrowReverse" => "boxRainGrowReverse"));
	
	$options[] = array( "name" => "",
						"desc" => "Number of slices (for slices animation)",
						"id" => "nivo_slices",
						"std" => "15",
						"type" => "select",
						"class" => "mini",
						"options" => $array_integer);
						
	$options[] = array( "name" => "",
						"desc" => "Number of box per column (for box animation)",
						"id" => "nivo_box_cols",
						"std" => "8",
						"type" => "select",
						"class" => "mini",
						"options" => $array_integer);
						
	$options[] = array( "name" => "",
						"desc" => "Number of box per row (for box animation)",
						"id" => "nivo_box_rows",
						"std" => "4",
						"type" => "select",
						"class" => "mini",
						"options" => $array_integer);
	
	$options[] = array( "name" => "",
						"desc" => "Animation speed",
						"id" => "nivo_anim_speed",
						"std" => "500",
						"type" => "select",
						"class" => "mini",
						"options" => $ms_array);

	$options[] = array( "name" => "",
						"desc" => "Pause time",
						"id" => "nivo_pause_time",
						"std" => "4000",
						"type" => "select",
						"class" => "mini",
						"options" => $ms_array_2);
						
	$options[] = array( "name" => "",
						"desc" => "Show control navigation",
						"id" => "nivo_control_navigation",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "",
						"desc" => "Activate keyboard navigation",
						"id" => "nivo_keyboard_navigation",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "",
						"desc" => "Pause on Hover",
						"id" => "nivo_pause_on_hover",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "",
						"desc" => "Caption opacity",
						"id" => "nivo_caption_opacity",
						"std" => "0.7",
						"type" => "select",
						"class" => "mini",
						"options" => $array_float);
						
	$options[] = array( "name" => "Polaroid Exclusive Slider",
						"desc" => "Pause time",
						"id" => "polaroid_pause_time",
						"std" => "5000",
						"type" => "select",
						"class" => "mini",
						"options" => $ms_array_2);
	
	$options[] = array( "name" => "Texture overlay for every slider",
						"desc" => "Add a texture overlay on the images slider",
						"id" => "slider_texture",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "",
						"desc" => "Choose the texture overlay",
						"id" => "slider_texture_image",
						"std" => "noisestrip",
						"type" => "images",
						"options" => array(
							'cross' => $texturepath . 'cross.png',
							'dot' => $texturepath . 'dot.png',
							'plus' => $texturepath . 'plus.png',
							'raster' => $texturepath . 'raster.png',
							'star' => $texturepath . 'star.png',
							'strip1' => $texturepath . 'strip1.png',
							'strip2' => $texturepath . 'strip2.png',
							'strip3' => $texturepath . 'strip3.png',
							'strip4' => $texturepath . 'strip4.png',
							'noisestrip' => $texturepath . 'noisestrip.png',
							)
						);
	
	
	
	
	/*-----------------------------------------------*/
	/* Portfolio
	/*-----------------------------------------------*/
	$options[] = array( "name" => "Portfolio",
						"type" => "heading");
						
	$options[] = array( "name" => "Slug configuration",
						"desc" => "This will be your portfolio url (example: ".get_bloginfo('url')."/your-slug/)",
						"id" => "portfolio_slug",
						"std" => "portfolio",
						"type" => "text");
						
	$options[] = array( "name" => "Layout configuration",
						"desc" => "Choose between normal layout (with sidebar) and fullwidth",
						"id" => "portfolio_layout",
						"std" => "fullwidth",
						"type" => "select",
						"class" => "mini",
						"options" => array('normal' => 'Normal', 'fullwidth' => 'Fullwidth'));
	
	$options[] = array( "name" => "Extra on single Portfolio page",
						"desc" => "Show project date",
						"id" => "portfolio_date",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "",
						"desc" => "Show category",
						"id" => "portfolio_category",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "Information about Portfolio item where all items are listed",
						"desc" => "Show title before image",
						"id" => "portfolio_title",
						"std" => "1",
						"type" => "checkbox");
	
	$options[] = array( "name" => "",
						"desc" => "Show description after image",
						"id" => "portfolio_desc",
						"std" => "1",
						"type" => "checkbox");					
	
	
	/*-----------------------------------------------*/
	/* Contact
	/*-----------------------------------------------*/
	$options[] = array( "name" => "Contact",
						"type" => "heading");
						
	$options[] = array( "name" => "",
						"desc" => "Short message",
						"id" => "contact_message",
						"std" => "<h6>Hey !</h6><br /><p>Feel free to contact us by mail using the form on the right, by passing by in our office, or call us between 9 to 5 during the week day.</p>",
						"type" => "textarea");
	
	$options[] = array( "name" => "",
						"desc" => "Address",
						"id" => "contact_address",
						"std" => "39, Plaça Catalunya<br />08002 Barcelona - Spain",
						"type" => "textarea");
						
	$options[] = array( "name" => "",
						"desc" => "Phone",
						"id" => "contact_phone",
						"std" => "+34 999 999 999<br />+34 999 888 888",
						"type" => "textarea");
						
	$options[] = array( "name" => "",
						"desc" => "Map shortcode",
						"id" => "contact_map",
						"std" => '[googlemap width="440" height="210" src="http://maps.google.es/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=Plaza+de+Catalu%C3%B1a,+Barcelona&amp;aq=1&amp;sll=40.396764,-3.713379&amp;sspn=10.252746,15.644531&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=&amp;t=m&amp;view=map&amp;z=16&amp;ll=41.386579,2.169426&amp;output=embed"]',
						"type" => "textarea");
						
	/*-----------------------------------------------*/
	/* Footer
	/*-----------------------------------------------*/
	$options[] = array( "name" => "Footer",
						"type" => "heading");
						
	$options[] = array( "name" => "Number of columns",
						"desc" => "",
						"id" => "footer_cols",
						"std" => "4",
						"type" => "radio",
						"options" => array('3' => '3', '4' => '4'));
						
	$options[] = array( "name" => "Copyright",
						"desc" => "",
						"id" => "footer_copyright",
						"std" => "Humble © 2011. All rights reserved.",
						"type" => "textarea");
						
	$options[] = array( "name" => "Text align of the copyright",
						"desc" => "",
						"id" => "footer_copyright_text_align",
						"std" => "center",
						"type" => "radio",
						"options" => array('' => 'Left', 'center' => 'Center', 'tar' => 'Right'));
			
	return $options;
}