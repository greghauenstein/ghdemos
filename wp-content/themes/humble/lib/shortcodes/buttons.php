<?php
function theme_shortcode_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id' => false,
		'class' => false,
		'link' => '',
		'target' => '',
		'rel' => false,
		'color' => 'white',
		'bgcolor' => '',
		'textcolor' => '',
		'align' => false
	), $atts));
	
	$id = $id?' id="'.$id.'"':'';
	$rel = ($rel===false)?'':' rel="'.$rel.'"';
	$color = $color?' '.$color:'';
	$class = $class?' '.$class:'';
	$link = $link?' href="'.$link.'"':'';
	$target = $target?' target="'.$target.'"':'';
	
	if (($bgcolor!='')&&($textcolor!='')) {
		$bgcolor = ' style="background:'.$bgcolor.'; color:'.$textcolor.'"';
		$textcolor = '';
		$color = ' custom';
	} else {
		$bgcolor = $bgcolor?' style="background:'.$bgcolor.';text-shadow:none;"':'';
		$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
	}
	
	$content = '<a'.$id.$link.$target.$bgcolor.$rel.$textcolor.' class="button'.$color.$class.'"><span>' . trim($content) . '</span></a>';
	
	if($align === 'center'){
		return '<p class="center">'.$content.'</p>';
	}else{
		return $content;
	}
}
add_shortcode('button','theme_shortcode_button');