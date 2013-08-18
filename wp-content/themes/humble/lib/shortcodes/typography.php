<?php
/*-----------------------------------------------*/
/* HR
/*-----------------------------------------------*/
function theme_shortcode_hr( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'class' => ''
	), $atts ) );
	
	return '<hr class="sep_line">';
}
add_shortcode('line', 'theme_shortcode_hr');


/*-----------------------------------------------*/
/* LIST
/*-----------------------------------------------*/
function theme_shortcode_list($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
	), $atts));

	return str_replace('<ul>', '<ul class="customlist list-'.$style.'">', do_shortcode($content));
}
add_shortcode('list', 'theme_shortcode_list');


/*-----------------------------------------------*/
/* BLOCKQUOTE
/*-----------------------------------------------*/
function theme_shortcode_blockquote($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
		'author' => false,
	), $atts));
	
	return '<blockquote' . ($align ? ' class="align' . $align . '"' : '') . '>' . do_shortcode($content) . ($author ? '<p><cite>- ' . $author . '</cite></p>' : '') . '</blockquote>';
}
add_shortcode('blockquote', 'theme_shortcode_blockquote');



/*-----------------------------------------------*/
/* Disable Automatic Formatting on Posts
/* Credit to TheBinaryPenguin (http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode)
/*-----------------------------------------------*/
function theme_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');
add_filter('the_content', 'theme_formatter', 99);


/*-----------------------------------------------*/
/* DROPCAPS
/*-----------------------------------------------*/
function theme_shortcode_dropcaps($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'color' => '',
	), $atts));

	if($color){
		$color = ' '.$color;
	}
	return '<span class="' . $code.$color . '">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'theme_shortcode_dropcaps');
add_shortcode('dropcap2', 'theme_shortcode_dropcaps');
add_shortcode('dropcap3', 'theme_shortcode_dropcaps');
add_shortcode('dropcap4', 'theme_shortcode_dropcaps');

/*-----------------------------------------------*/
/* HIGHLIGHT
/*-----------------------------------------------*/
function theme_shortcode_highlight($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'type' => 'red',
	), $atts));

	return '<span class="highlight '.$type.'">'.do_shortcode($content).'</span>';
}
add_shortcode('highlight', 'theme_shortcode_highlight');



/*-----------------------------------------------*/
/* CODE AND PRE HACK
/*-----------------------------------------------*/
global $theme_code_token;
$theme_code_token = md5(uniqid(rand()));
$theme_code_matches = array();
function theme_code_before_filter($content) {
	return preg_replace_callback("/(.?)\[(pre|code)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\\2\])?(.?)/s", "theme_code_before_filter_callback", $content);
}

function theme_code_before_filter_callback(&$match) {
	global $theme_code_token, $theme_code_matches;
	$i = count($theme_code_matches);
	
	$theme_code_matches[$i] = $match;
	
	return "\n\n<p>" . $theme_code_token . sprintf("%03d", $i) . "</p>\n\n";
}

function theme_code_after_filter($content) {
	global $theme_code_token;
	
	$content = preg_replace_callback("/<p>\s*" . $theme_code_token . "(\d{3})\s*<\/p>/si", "theme_code_after_filter_callback", $content);
	
	return $content;
}
function theme_code_after_filter_callback($match) {
	global $theme_code_matches;
	$i = intval($match[1]);
	$content = $theme_code_matches[$i];
	$content[5]=trim($content[5]);
	
	if (version_compare(PHP_VERSION, '5.2.3') >= 0) {
		$output = htmlspecialchars($content[5], ENT_NOQUOTES, get_bloginfo('charset'), false);
	} else {
		$specialChars = array('&' => '&amp;', '<' => '&lt;', '>' => '&gt;');
		
		$output = strtr(htmlspecialchars_decode($content[5]), $specialChars);
	}
	return '<' . $content[2] . ' class="'. $content[2] .'">' . $output . '</' . $content[2] . '>';
}

add_filter('the_content', 'theme_code_before_filter', 0);
add_filter('the_content', 'theme_code_after_filter', 99);