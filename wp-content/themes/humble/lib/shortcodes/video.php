<?php

function theme_shortcode_video($atts){
	if(isset($atts['type'])){
		switch($atts['type']){
			case 'youtube':
				return theme_video_youtube($atts);
				break;
			case 'vimeo':
				return theme_video_vimeo($atts);
				break;
		}
	}
	return '';
}
add_shortcode('video', 'theme_shortcode_video');

//VIMEO
function theme_video_vimeo($atts) {
	extract(shortcode_atts(array(
		'clip_id' 	=> '',
		'width' => 610,
		'height' => false,
		'byline'    => 0,
		'title'     => 0,
		'portrait'  => 0,
		'autoplay'  => 0,
		'loop'      => 0
	), $atts));

	if (!$height) $height = intval($width * 9 / 16);

	if (!empty($clip_id) && is_numeric($clip_id)){
		return "<div class='video'><iframe class='vimeo' style='height:{$height}px;width:{$width}px' src='http://player.vimeo.com/video/$clip_id?title={$title}&amp;byline={$byline}&amp;portrait={$portrait}&amp;autoplay={$autoplay}&amp;loop={$loop}' width='$width' height='$height' frameborder='0'></iframe></div>";
	}
}

//YOUTUBE
function theme_video_youtube($atts, $content=null) {
	extract(shortcode_atts(array(
		'clip_id' 	=> '',
		'width' 	=> 610,
		'height' 	=> false,
		'hd'        => 1
	), $atts));
	
	if (!$height) $height = intval($width * 9 / 16) + 25;

	if (!empty($clip_id)){
		return "<div class='video'><iframe width='{$width}' height='{$height}' src='http://www.youtube.com/embed/{$clip_id}?hd={$hd}' frameborder='0' allowfullscreen></iframe></div>";
	}
}
