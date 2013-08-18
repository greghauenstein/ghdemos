<?php
function theme_shortcode_image($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'size' => 'medium',
		'link' => '#',
		'target' => false,
		'lightbox' => false,
		'title' => '',
		'align' => false,
		'group' => '',
		'width' => false,
		'height' => false,
		'autoheight' => false
	), $atts));
	
	if ($size != 'fullwidth') {
		if (!$width) {
			$width = of_get_option('image_'.$size.'_width', 200);
		}
		if (!$height) {
			$height = of_get_option('image_'.$size.'_height', 150);
		}
	} else {
		$width = 910;
		$height = '';
	}
		
		if ($autoheight == 'true') {
			$height = '';
		}
	
	$src = trim($content);
	
	if ($lightbox == 'true') {
		if ($link == '#') {
			$link = $src;
		}
	}
	
	$target = $target ? ' target="'.$target.'"' : '';
	
	$content = '<img width="'.$width.'" '.((empty($height))?'':'height="'.$height.'"'). 'alt="'.$title.'" src="'.get_bloginfo('template_directory').'/timthumb.php?src='.$src.((empty($height))?'':'&amp;h='.$height).'&amp;w='. $width .'&amp;zc=1&amp;q=100" />';
		return '<div class="img_styled'.($align?' align'.$align:'').'"><div class="img_frame img_size_'.$size.'" style="width:'.$width.'px;'.((empty($height))?'':'height:'.$height.'px').'"><a'.($group?' rel="'.$group.'"':'').$target.' class="'.($lightbox =='true'?' fancy':'').'" title="'.$title.'" '.($link=='#'? '':' href="'.$link.'"').'>' . $content.($lightbox =='true'?'<span class="overlay_glass"></span>':'').'</a></div></div>';
		
}

add_shortcode('image', 'theme_shortcode_image');