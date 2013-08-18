<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">

	<!-- metatags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- title -->
	<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
	
	<!-- favicon -->
	<link rel="shortcut icon" href="" />
	
	<!-- stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/cache/custom.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

	<!-- rss, atom & pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- wp_head() -->
	<?php wp_head(); ?>
	
	<?php
	$slider = of_get_option('slider');
	$demo_polaroid = get_post_meta(get_the_ID(), 'demo_polaroid', true);
	if ($demo_polaroid == '1') $slider = 'polaroid';
	?>
  	
  	<?php if ($slider == 'nivo_slider') : ?>
  	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.nivo.slider.pack.js"></script>
  	<script type="text/javascript">
    $(window).load(function() {
        $('#nivo').nivoSlider({
        	effect			: '<?php echo of_get_option('nivo_effect', 'random') ?>',
	        slices			: <?php echo of_get_option('nivo_slices', '15') ?>, 
	        boxCols			: <?php echo of_get_option('nivo_box_cols', '8') ?>,
	        boxRows			: <?php echo of_get_option('nivo_box_rows', '4') ?>,
	        animSpeed		: <?php echo of_get_option('nivo_anim_speed', '500') ?>,
	        pauseTime		: <?php echo of_get_option('nivo_pause_time', '3000') ?>,
	        directionNav	: false,
	        controlNav		: <?php echo of_get_option('nivo_control_navigation') == '0' ? 'false':'true'; ?>,
	        keyboardNav		: <?php echo of_get_option('nivo_keyboard_navigation') == '0' ? 'false':'true'; ?>,
	        pauseOnHover	: <?php echo of_get_option('nivo_pause_on_hover') == '0' ? 'false':'true'; ?>,
	        captionOpacity	: <?php echo of_get_option('nivo_caption_opacity', '0.7') ?>
        });
    });
    </script>
  	<?php endif; //nivo ?>
  	
  	<?php if ($slider == 'polaroid') : ?>
  	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/polaroid.js"></script>
  	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/polaroid.css" type="text/css" media="screen" />
  	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.backopacity.js"></script>
  	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.preloader.js"></script>
  	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.transform-0.8.0.min.js"></script>
  	<script type="text/javascript">
  		var polaroid_pause = <?php echo of_get_option('polaroid_pause_time'); ?>;
  	</script>
  	<?php endif; //polaroid ?>
  	
  	<script type="text/javascript">
  		$(document).ready(function() { 
	    	$('a.fancy').fancybox({
				'transitionIn'		:	'<?php echo of_get_option('lightbox_transition_in'); ?>',
				'transitionOut'		:	'<?php echo of_get_option('lightbox_transition_out'); ?>',
				'speedIn'			:	<?php echo of_get_option('lightbox_speed_in'); ?>, 
				'speedOut'			:	<?php echo of_get_option('lightbox_speed_out'); ?>,
				'titlePosition'		:	'<?php echo of_get_option('lightbox_caption_position'); ?>',
				'showCloseButton' 	:	<?php echo of_get_option('lightbox_close_button'); ?>,
				'showNavArrows'		:	<?php echo of_get_option('lightbox_nav_arrows'); ?>
			});
	    });
  	</script>
  	
  	<!-- Body Background -->
  	<?php
  	$default_bg = of_get_option('background');
  	
  	if (is_singular()) {
  		$bg = array();
  		$bg['color'] = get_post_meta(get_the_ID(), '_hb_bg_color', true);
  		$bg['image'] = get_post_meta(get_the_ID(), '_hb_bg_image', false);
  		$bg['image'] = empty($bg['image']) ? '' : $bg['image'][0];
  		$bg['repeat'] = get_post_meta(get_the_ID(), '_hb_bg_repeat', true);
  		$bg['position'] = get_post_meta(get_the_ID(), '_hb_bg_position', true);
  		$bg['attachment'] = get_post_meta(get_the_ID(), '_hb_bg_attachment', true);	
  	} else {
  		$bg = array('color' => '', 'image' => '');
  	}
  	
  	
  	?>
  	
  	
  	<style>
  	<?php if (($bg['color'] == '') && ($bg['image'] == '')) : ?>
	  	<?php if ($default_bg['image'] == '') : ?>
	  		body { background-color: <?php echo $default_bg['color']; ?> }
	  	<?php else : ?>
		  	body { background: <?php echo $default_bg['color'].' url('.$default_bg['image'].') '.$default_bg['repeat'].' '.$default_bg['position'].' '.$default_bg['attachment']; ?>; }
		<?php endif; ?>
	<?php else : ?>
		<?php if ($bg['image'] == '') : ?>
	  		body { background-color: <?php echo $bg['color']; ?> }
	  	<?php else : ?>
		  	body { background: <?php echo $bg['color'].' url('.$bg['image'].') '.$bg['repeat'].' '.$bg['position'].' '.$bg['attachment']; ?>; }
		<?php endif; ?> 
	<?php endif; ?>
  	</style>
  	
  	<?php if (of_get_option('google_analytics') != '') { ?>
	  	<script type="text/javascript">
	  	<?php echo of_get_option('google_analytics'); ?>
	  	</script>
  	<?php } ?>
</head>

<body <?php body_class(); ?>>

	<div id="wrapper" class="container_12">

		<div id="header-holder">
		
			<div id="header">
			
				<div id="nav" class="grid_8">
				
				<?php if (has_nav_menu('header-menu')) : ?>
					
					<?php wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' => 'sf-menu', 'container' => '')); ?>
					
				<?php else:?>
				
		            <ul class="sf-menu">
		                <?php wp_list_pages( array( 'exclude' => '', 'title_li' => '' )); ?>
		            </ul>
		            
	            <?php endif; ?>
				</div>
				
				<div id="logo" class="grid_4">
					<?php
					$logo = of_get_option('logo');
					?>
					<a href="<?php bloginfo('url'); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
				</div>
				
			</div><!-- #header -->
		
		</div><!-- #header-holder -->