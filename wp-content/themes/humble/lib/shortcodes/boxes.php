<?php

function theme_shortcode_message($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	return '<div class="' . $code . ' ' . $class . '"><div class="message_box_content">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('info','theme_shortcode_message');
add_shortcode('success','theme_shortcode_message');
add_shortcode('error','theme_shortcode_message');
add_shortcode('notice','theme_shortcode_message');
add_shortcode('message','theme_shortcode_message');