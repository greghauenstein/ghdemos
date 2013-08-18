<?php
/*-----------------------------------------------*/
/* Load JS Script - jQuery from Google Lib
/*-----------------------------------------------*/

function humble_init_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');
        wp_register_script('superfish', get_bloginfo('template_directory') . '/js/superfish.js', 'jquery');
        wp_register_script('easing', get_bloginfo('template_directory') . '/js/jquery.easing.js', 'jquery');
        wp_register_script('fancybox', get_bloginfo('template_directory') . '/js/fancybox/jquery.fancybox-1.3.4.pack.js', 'jquery');
        wp_register_script('tabs', get_bloginfo('template_directory') . '/js/jquery.tools.tabs.min.js', 'jquery');
        wp_register_script('custom', get_bloginfo('template_directory') . '/js/custom.js', 'jquery');
        
        wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('easing');
		wp_enqueue_script('fancybox');
		wp_enqueue_script('tabs');
		wp_enqueue_script('custom');
		wp_enqueue_script('comment-reply');
    }
}    
 
add_action('init', 'humble_init_jquery');

?>