<?php
function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'open' => ''
	), $atts));	
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i=0;$i<3;$i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '<div id="boxes">';
		
		
		for ($i=0;$i<3;$i++) {
			if ($matches[3][$i]['title'] != '' && $matches[3][$i]['description'] != '') {
				if ($i == 0) {
					$class = 'alpha';
				} elseif ($i == 2) {
					$class = 'omega';
				} else {
					$class = '';
				}
				
				$output .= '<div class="grid_4 '.$class.'" id="box'.($i+1).'">';
				$output .= '	<h3>'.$matches[3][$i]['title'].'</h3>';
				if ($matches[3][$i]['image'] != '')
					$output .= '	<img src="'.$matches[3][$i]['image'].'" />';
				$output .= '	<p>'.$matches[3][$i]['description'].'</p>';
				$output .= '</div>';
			}
		}			
	
		$output .= '	<div class="clear"></div>';
		$output .= '</div> <!-- #boxes -->';

		$output .= '<div id="boxes_content">';
		
		for ($i=0;$i<3;$i++) {
			$output .= '<div id="box'.($i+1).'_content" class="box_content">';
			$output .= do_shortcode($matches[5][$i]);
			$output .= '</div>';
		}
	
		$output .= '</div> <!-- #boxes_content -->';
		$output .= '<div class="clear"></div>';
		
		if ($open) {
			$output .= "
			<script type='text/javascript'>
				$(document).ready(function() { 
					$('#boxes #box1').click();
					$('#boxes #box2').stop().animate({ opacity: 0.5 }, 200);
					$('#boxes #box3').stop().animate({ opacity: 0.5 }, 200);
				});
			</script>
			";
		}
		
		
		return $output;
		
	}
}
add_shortcode('tabs', 'theme_shortcode_tabs');