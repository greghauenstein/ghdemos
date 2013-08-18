<?php
function hb_googleMaps($atts, $content = null) {  
   extract(shortcode_atts(array(  
      "width" => '610',  
      "height" => '400',  
      "src" => ''  
   ), $atts));  
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'"></iframe>';  
}  
add_shortcode("googlemap", "hb_googleMaps");  