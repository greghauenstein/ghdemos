<?php 
	global $theme_options;
?>
<style type='text/css'>

<?php
	// Primary Colors 
	
	$primary = (isset($theme_options['cp_primary_color']) AND !empty($theme_options['cp_primary_color'])) ? $theme_options['cp_primary_color'] : "521d81";
	$primary = new CSS_Color($primary);	
?>

a {
	color: #<?php echo $primary->bg['0'] ?>;
}
#site-nav ul li a {
	border-color: #<?php echo $primary->bg['+2'] ?>;
}

#site-nav ul li.current_page_item a,#site-nav ul li.current_page_item ul li a:hover {
	border-color: #<?php echo $primary->bg['+2'] ?>;
}

#page-title-bg, .page-title-bg{
	background: #<?php echo $primary->bg['0'] ?>;
}

#site-container h1, #site-container h2 	{
	color: #<?php echo $primary->bg['0'] ?>;
}

.post-content h1, .post-content h2, .post-content h3, .post-content h4,.post-content h5, .post-content h6 {
	color: #<?php echo $primary->bg['0'] ?>;
}

.post-content a {
	color: #<?php echo $primary->bg['0'] ?>;
}

#site-footer #footer-nav a:hover {
	color: #<?php echo $primary->bg['+2'] ?>;
}

.widget-title {
	color: #<?php echo $primary->bg['0'] ?>;
}

.comment .fn a {
	color: #<?php echo $primary->bg['0'] ?>;
}

#reply-title {
	color: #<?php echo $primary->bg['0'] ?>;
}

#respond #commentform input:focus,#respond #commentform textarea:focus {
	outline:3px solid #<?php echo $primary->bg['+3'] ?> !important;
}

.post-content input:focus, .post-content textarea:focus {
	outline:3px solid #<?php echo $primary->bg['+3'] ?> !important;
}

.post-content label, .wpcf7-form p {
	color: #<?php echo $primary->bg['+3'] ?>;
}

.tags h3 {
	color: #<?php echo $primary->bg['0'] ?>;
}

#viewCartTable th {
	color: #<?php echo $primary->bg['0'] ?>;
}

#portfolio ul.portfolio-filter li a:hover, #portfolio ul.portfolio-filter li a.current  {
	background:#<?php echo $primary->bg['0'] ?>;
}

#portfolio li.portfolio-item h4  {
	color: #<?php echo $primary->bg['0'] ?>;
}

.section-box.share h3 {
	color: #<?php echo $primary->bg['0'] ?>;
}

.selection {
	background: #<?php echo $primary->bg['0'] ?> !important;
	color: #<?php echo $primary->bg['5'] ?> !important;
}

<?php
	// Background
	
	$background = (isset($theme_options['cp_bg_color']) AND !empty($theme_options['cp_bg_color'])) ? "#".$theme_options['cp_bg_color'] : "";
	$background = (isset($theme_options['cp_bg_image']) AND !empty($theme_options['cp_bg_image'])) 
		? "url(".$theme_options['cp_bg_image'] .")"
		: $background;
	
	
	if($background) :	
?>
	body {
		background: <?php echo $background ?> !important;
	}
<?php endif ?>

<?php
	// Slider Background
	
	$background = (isset($theme_options['cp_slider_background']) AND !empty($theme_options['cp_slider_background'])) ? "background:url(".$theme_options['cp_slider_background'].')' : "";
	
	
	if($background) :	
?>
	#site-header {
		<?php echo $background ?> !important;
	}
<?php endif ?>



</style>