<?php
function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h4 class="toggle_title"><span></span>' . $title . '</h4><div class="toggle_content">' . do_shortcode(trim($content)) . '</div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');