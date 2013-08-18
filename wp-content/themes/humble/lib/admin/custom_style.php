<?php
$typography = of_get_option('css_typography');
$link_color = of_get_option('css_link');
$hover_color = of_get_option('css_hover');
$menu_active_color = of_get_option('css_menu_active');
$menu_content_opacity = of_get_option('css_content_opacity');
$css_slogan_h1_font_size = of_get_option('css_slogan_h1_font_size');
$css_slogan_h2_font_size = of_get_option('css_slogan_h2_font_size');
$slider_texture_image = of_get_option('slider_texture_image');
$font = of_get_option('font');
$css_h1 = of_get_option('css_h1');
$css_h2 = of_get_option('css_h2');
$css_h3 = of_get_option('css_h3');
$css_h4 = of_get_option('css_h4');
$css_h5 = of_get_option('css_h5');
$css_h6 = of_get_option('css_h6');
$logo_position = of_get_option('logo_position');

return "
@import url('../font/{$font}/font.css');

body { font: {$typography['style']} normal normal {$typography['size']}/normal {$typography['face']}; color: {$typography['color']}; }

h1{ font-size:{$css_h1}; }
h2{ font-size:{$css_h2}; }
h3{ font-size:{$css_h3}; }
h4{ font-size:{$css_h4}; }
h5{ font-size:{$css_h5}; }
h6{ font-size:{$css_h6}; }

h1, h2, h3, h4, h5, h6, #nav ul li a, blockquote cite {
	font-family:  \"{$font}Regular\";
}

blockquote p {
	font-family: \"{$font}Italic\";
}

a, #portfolio #filters a.current, ul.minitabs a:hover { color:{$link_color}; }

#sidebar .hb_flickr_widget .flickr_badge_image img:hover, #footer .hb_flickr_widget .flickr_badge_image img:hover { border-color:{$hover_color}; }

a:hover, .entry h3.title a:hover, #post_content .meta .comment a:hover, .entry .meta .comment a:hover, #breadcrumb a:hover, #sidebar a:hover, #sidebar .hb_flickr_widget .flickr_badge_image img:hover, #footer .hb_flickr_widget .flickr_badge_image img:hover, #footer .hb_recentpost_widget .recentpost h5 a:hover, #sidebar .hb_tweet_widget #twitter_update_list li span a:hover, #footer .hb_tweet_widget #twitter_update_list li span a:hover, #comments .details .name span.date a:hover, #respond a:hover, ol.pinglist li a:hover, #portfolio .one_col h3 a:hover, #portfolio .one_col .comment a:hover, #portfolio h3.mini_title a:hover { color: {$hover_color}; }

#nav ul li.current_page_item > a, #nav ul li.current_page_parent > a, #nav ul li.current-menu-item > a, #nav ul li.current-post-ancestor > a, #nav ul li.current-page-parent > a { background-color: {$menu_active_color}; }
#nav ul li ul.children li.current_page_item > a, #nav ul li ul.sub-menu li.current_page_item > a { color: {$menu_active_color}!important; }

.container_12 { background-color: rgba(255, 255, 255, {$menu_content_opacity}); }

#slide #sleft h1 { font-size: {$css_slogan_h1_font_size}; }
#slide #sleft h2 { font-size: {$css_slogan_h2_font_size}; }

#slide #sright #texture { background: transparent url(../images/textures/{$slider_texture_image}.png) repeat 0 0; }

#nav { float: {$logo_position};}
";