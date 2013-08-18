<?php

// [line]
function line_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[line]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>' . $html . '</span><br />';
	}
	else {
		return '<span class="devider"></span>';
	}
}
add_shortcode('line', 'line_shortcode');



// [linetop]
function line_top_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[linetop]';
			return '<div class="sc_sample"><h5>Shortcode:</h5>' . $html . '</div><br />';   		
	}
	else {
		return '<div class="divider"><a href="#">Top</a></div>';
	}
}
add_shortcode('linetop', 'line_top_shortcode');



// [column]
function column_shortcode( $atts, $content = null ) {
	
   	extract( shortcode_atts( array(
		'size' => '2x1',
		'last' => false,
		'sample' => false,
		'vertical_align' => 'baseline',
		'first' => false,
	), $atts ) );
	$html = '<div class="column column' . $size;
	if ($last) $html .= ' last';
	if ($first) $html .= ' first';
	$html .= '">';
	$html .= do_shortcode($content) . '</div>';
	if ($last) $html .= '<div class="clear"></div>';
	if ($sample) {
		$html = '[column size="' . $size . '"';
		if ($last) $html .= ' last="true"';
		$html .= ']';
		$html .= '<br />Your content here<br />[/column]';
   		$html = '<span class="sc_sample"><h5>Shortcode:</h5>' . $html . '</span><br />';
	}


	return $html;
	
}
add_shortcode('column', 'column_shortcode');



// [selection]
function selection_shortcode( $atts, $content = null ) {
   	extract( shortcode_atts( array(
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[selection] Your content here [/selection]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>' . $html . '</span><br />';
	}
	else {
		$html = '<span class="selection">';
		$html .= do_shortcode($content) . '</span>';
		return $html;
	}
}
add_shortcode('selection', 'selection_shortcode');



// [toggle]
function toggle_shortcode( $atts, $content = null ) {
   	extract( shortcode_atts( array(
		'title' => '',
		'fold' => 'true',
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[toggle title="' . $title . '" fold="' . $fold . '"]<br />Your content here<br />[/toggle]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>' . $html . '</span><br />';
	}
	else {
		$html = '<div class="toggle';
		if ($fold == 'true') {
			$html .= ' fold';
		}
		$html .= '"><h4 class="title">' . $title . '</h4><div class="toggle-content">' . do_shortcode($content) . '</div></div>';
		return $html;
	}
}
add_shortcode('toggle', 'toggle_shortcode');



// [button]
function button_shortcode( $atts ) {
   	extract( shortcode_atts( array(
		'title' => 'Read more',
		'color' => 'aaaaaa',
		'url' => '#',
		'float' => 'none',
		'top' => '0',
		'bottom' => '0',
		'left' => '0',
		'right' => '0',
		'sample' => false,
		'textcolor' => "light",
		'gradient' => true,
	), $atts ) );


	if ($sample) {
		$html = '[button title="'.$title.'" url="'.$url.'" color="'.$color.'" float="'.$float.'" top="'.$top.'" right="'.$right.'" bottom="'.$bottom.'" left="'.$left.'"]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>' . $html . '</span><br />';
	}
	
	else {
	
		$colors = array(
			"magenta" => "ff00ff",
			"cyan" => "24ACD2",
			"yellow" => "E3C137",
			"black" => "3C3C3C",
			"red" => "D12344",
			"blue" => "458BC0",
			"green" => "77AE42",
			"purple" => "B244AC",
			"orange" => "DB8E4E",
		);
		
		$class_colorname = in_array($color, array_keys($colors)) ? $color : '';
		if($class_colorname != '') {
			$color = $colors[$color];
		}
		
		$class_gradient = (isset($gradient) AND ($gradient === true OR $gradient == 'true') ) ? "gradient" : "";
		$class_textcolor = ($textcolor == 'dark') ? "dark-text" : '';
		
		$styles = '';
		if($class_colorname == '' OR !in_array($textcolor, array('dark', 'light')) ){
			$styles = array();
			$color = new CSS_Color($color);
				
			if($class_colorname == '') {
				$styles[] = "border:1px solid #".$color->bg['-1'];
				$styles[] = "text-shadow:-1px -1px 1px #".$color->bg['-2'];
				if($gradient == true) {
					$start = $color->bg['+1'];
					$end = $color->bg['-1'];
					$styles[] = "background:-webkit-gradient(linear, left top, left bottom, from(#".$start."), to(#".$end."))";
					$styles[] = "background:-moz-linear-gradient(top,  #".$start.",  #".$end.")";				
					$styles[] = "background:progid:DXImageTransform.Microsoft.gradient_maker( startColorstr='#".
						$start."', endColorstr='#".$end."',GradientType=0 )";
				}
				else{
					$styles[] = "background:#".$color->bg['0'];
				}

			}
			
			if(!in_array($textcolor, array('dark', 'light'))) {
				$textcolor = new CSS_Color($textcolor);
				$styles[] = "color:#".$textcolor->bg['0'];
			}
			

			
		}
			$styles[] = "margin:".$top."px ".$right."px ".$bottom."px ".$left."px ";
		
			if($styles) {
				$styles = 'style="'.implode(';', $styles).'"';
			}

	
		$html = '<a '.$styles.' href="'.$url.'" class="button '.$class_colorname.' '.$class_gradient.' '.$class_textcolor.'">'.$title.'</a>';
		return $html;
	}
}
add_shortcode('button', 'button_shortcode');



// [message]
function message_shortcode( $atts, $content = null ) {
   	extract( shortcode_atts( array(
		'title' => '',
		'type' => '',
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[message type="'.$type.'" title="'.$title.'"]<br />Your content here<br />[/message]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>'.$html.'</span><br />';
	}
	else {
		$html = '<div class="message '.$type.'"><h5 class="title">'.$title.'</h5>'.do_shortcode($content).'</div>';
		return $html;
	}
}
add_shortcode('message', 'message_shortcode');



// [maps]
function maps_shortcode( $atts ) {
   	extract( shortcode_atts( array(
		'location' => '',
		'zoom' => '10',
		'popup' => 'no',
		'height' => '400px',
		'width' => '100%',
		'sample' => false,
	), $atts ) );
	if ($sample) {
		$html = '[maps location="'.$location.'" zoom="'.$zoom.'" popup="'.$popup.'" width="'.$width.'" height="'.$height.'"]';
   		return '<span class="sc_sample"><h5>Shortcode:</h5>'.$html.'</span><br />';
	}
	else {
		$location = str_replace(' ','+',$location);
		if ($popup == 'yes') {
			$popup = 'A';
		} else {
			$popup = 'B';
		}
		$source = htmlentities('http://maps.google.com/maps?f=q&source=s_q&q='.$location.'&ie=UTF8&z='.$zoom.'&iwloc='.$popup.'&output=embed');
		$html = '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$source.'"></iframe><br /><br />';
		return $html;
	}
}
add_shortcode('maps', 'maps_shortcode');

?>