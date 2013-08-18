<?php

if ( !function_exists( 'optionsframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/lib/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/lib/admin/');
define('LIBPATH', TEMPLATEPATH . '/lib/');
define('LIBDIRECTORY', get_bloginfo('template_directory') . '/lib/');

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

//Custom script for the panel

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
}

/*-----------------------------------------------*/
/* CUSTOM META BOX
/*-----------------------------------------------*/
include( LIBPATH . 'metabox/options.php');
include( LIBPATH . 'metabox/init.php');


/*-----------------------------------------------*/
/* Turns off the default options panel from Twenty Eleven
/*-----------------------------------------------*/
add_action('after_setup_theme','remove_twentyeleven_options', 100);
function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}



/*-----------------------------------------------*/
/* jQuery script load
/*-----------------------------------------------*/
require_once (LIBPATH . 'functions/functions-js.php');


/*-----------------------------------------------*/
/* Others stuff
/*-----------------------------------------------*/
require_once (LIBPATH . 'functions/functions-others.php');

/*-----------------------------------------------*/
/* Sidebar
/*-----------------------------------------------*/
require_once (LIBPATH . 'functions/functions-sidebar.php');

/*-----------------------------------------------*/
/* Types
/*-----------------------------------------------*/
require_once (LIBPATH . 'types/portfolio.php');
require_once (LIBPATH . 'types/slide.php');

/*-----------------------------------------------*/
/* Menu
/*-----------------------------------------------*/
require_once (LIBPATH . 'functions/functions-menu.php');

/*-----------------------------------------------*/
/* Widget
/*-----------------------------------------------*/
require_once (LIBPATH . 'widgets/flickr.php');
require_once (LIBPATH . 'widgets/recentpost.php');
require_once (LIBPATH . 'widgets/tweets.php');
require_once (LIBPATH . 'widgets/social.php');
require_once (LIBPATH . 'widgets/subnav.php');

/*-----------------------------------------------*/
/* Shortcode
/*-----------------------------------------------*/
require_once (LIBPATH . 'shortcodes/column.php');
require_once (LIBPATH . 'shortcodes/boxes.php');
require_once (LIBPATH . 'shortcodes/buttons.php');
require_once (LIBPATH . 'shortcodes/blog.php');
require_once (LIBPATH . 'shortcodes/portfolio.php');
require_once (LIBPATH . 'shortcodes/tabs.php');
require_once (LIBPATH . 'shortcodes/typography.php');
require_once (LIBPATH . 'shortcodes/gallery.php');
require_once (LIBPATH . 'shortcodes/images.php');
require_once (LIBPATH . 'shortcodes/video.php');
require_once (LIBPATH . 'shortcodes/maps.php');
require_once (LIBPATH . 'shortcodes/others.php');
require_once (LIBPATH . 'shortcodes/tabs-mini.php');
require_once (LIBPATH . 'shortcodes/toggle.php');

?>