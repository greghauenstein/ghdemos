<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" type="image/ico" href="<?php bloginfo('template_url'); ?>/images/favico.png" />
<?php wp_head(); ?>
<!-- Remove this title tag if you plan on using the provided WP-SEO plugin, strongly suggested --!>
<title><?php bloginfo('name'); ?></title>
</head>
<body>
<div id="main_wrapper">
<div id="top_content">
<div class="search">
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</div>
<div class="avatar_holder"><div class="avatar"><img src="<?php bloginfo('template_url'); ?>/images/avatar.jpg" /></div><div class="currently"><p><b>Currently</b></p>
<p><?php bloginfo('description'); ?></p>
</div>
</div>
</div>
<div class="clear"></div>
<div id="header_wrapper">
<!-- Don't edit this, you can change the name by changing your blog title in the options --!>
<h1><?php bloginfo('name'); ?></h1>
<span class="publish_date"><?php the_time('Y/j') ?></span><a href="<?php bloginfo('wpurl'); ?>/index.php?pagename=archive-index">Archives</a> / <a href="<?php bloginfo('wpurl'); ?>/contact/">Contact</a>
</div>