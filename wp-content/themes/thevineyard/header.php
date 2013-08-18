<?php global $theme_options; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	
	<head profile="http://gmpg.org/xfn/11">

		<title><?php bloginfo('name'); ?></title>

		<!-- Site Meta Information -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="description" content="<?php bloginfo('description') ?>" />
		<meta name="generator" content="WordPress <?php bloginfo('version') ?>" />

		<!-- Site Favicon -->
		<link rel="icon" href="<?php echo $theme_options['cp_favicon']; ?>" type="image/x-icon" />
		
		<!-- RSS and pingback -->
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS Feed" href="<?php bloginfo('comments_rss2_url') ?>"  />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
		
		<?php wp_head(); ?>

		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/style.css">
		<?php include(TEMPLATEPATH."/style.php") ?>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/custom.css">		

		
		</head>

	<body <?php body_class(); ?>>
    	<div id="site-header-shadow">           
			<div id="site-header">
				
				<!-- The Website Logo or Logo Text -->
				
				<?php if(isset($theme_options['cp_bloglogo']) AND !empty($theme_options['cp_bloglogo'])) : ?>
					<a href='<?php echo home_url() ?>'><img id='site_title' name="<?php bloginfo() ?>" alt="<?php bloginfo() ?>" src='<?php echo $theme_options['cp_bloglogo'] ?>'></a>
				<?php else : ?>
					<h1 id="site-title"><a href='<?php echo home_url() ?>'><?php bloginfo() ?></a></h1>
				<?php endif ?>

				<!-- The Website Header Navigation and search -->
	
				<div id="site-nav">
					<div id="site-nav-menu">
						<?php wp_nav_menu('theme_location=main-menu&fallback_cb=rf_main_menu'); ?>
					</div>
					
					<div class="site-search">
						<?php get_search_form() ?>
					</div>
				
				</div>

				<!-- Title block inside the header (non-front page) -->
					
				<?php if(!is_front_page()) : ?>
					<div id="page-title">
					<div id="page-title-bg"></div>
						<h1>
						<?php
							if(is_singular("post")) {
								echo get_the_title(get_option("page_for_posts"));
							}
							elseif(is_singular("product") ) {
								echo get_the_title(get_page_by_path('store'));
							}
							else {
								wp_title("");
							}
						?>
						</h1>
					</div>
					
				<!-- Slider for the front page -->

				<?php else : ?>
					<?php get_template_part("includes/slider") ?>
				<?php endif ?>
			
			</div>
		</div>
		
		<div id="site-container-shadow">
			<div id="site-container">