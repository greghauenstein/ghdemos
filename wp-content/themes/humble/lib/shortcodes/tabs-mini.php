<?php

function theme_shortcode_minitabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'history' => false,
		'initialtab' => 1
	), $atts));
	
	if (!preg_match_all("/(.?)\[(minitab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/minitab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			if($history=='true'){
				$href= '#'.rawurlencode(str_replace(" ", "_", trim($matches[3][$i]['title'])));
			}else{
				$href = '#';
			}
			$output .= '<li><a href="'.$href.'">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		if($history=='true'){
			$data_history = ' data-history="true"';
		}else{
			$data_history = '';
		}
		if($initialtab!="1"){
			$initialIndex = $initialtab -1;
			$data_initialIndex = ' data-initialIndex="'.$initialIndex.'"';
		}else{
			$data_initialIndex = '';
		}
		
		return '<div class="'.$code.'_container"'.$data_history.$data_initialIndex.'>' . $output . '</div>';
	}
}
add_shortcode('minitabs', 'theme_shortcode_minitabs');