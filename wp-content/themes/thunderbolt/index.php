<?php get_header(); ?>
<div id="content_wrapper_single">
<div class="breadnav"><?php
if (class_exists('breadcrumb_navigation_xt')) {
// new breadcrumb object
$mybreadcrumb = new breadcrumb_navigation_xt;
// Options for breadcrumb_navigation_xt
$mybreadcrumb->opt['title_blog'] = 'Home';
$mybreadcrumb->opt['separator'] = ' &raquo; ';
$mybreadcrumb->opt['singleblogpost_prefix'] = '';
$mybreadcrumb->opt['singleblogpost_category_display'] = true;
// Display the breadcrumb
$mybreadcrumb->display();
}?></div>
<div class="content_left_single">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="single_post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanently: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="single_entry">
					<?php the_content_rss('', TRUE, '', 50); ?>
					</div>
                                        </div>
                       <?php endwhile; ?>
			<?php else : ?>
			<div class="single_post" id="post-<?php the_ID(); ?>">
				<h2>The robot died</h2>
				<div class="single_entry">
  <p><object width="425" height="355"><param name="movie" value="http://www.youtube.com/v/yYEBzoXmNZc&hl=en"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/yYEBzoXmNZc&hl=en" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed></object></p>
					<p>You might have searched for something that doesn't have any results. Or maybe you found a page that is no longer here.</p>
					<p>Either way, you can head back to the front page and try again <a href="<?php bloginfo('wpurl') ?>">here</a>.</p>
				</div>
			<div class="clear"></div>
			</div>
			<?php endif; ?>
</div>
<div class="single_post">
<h2><div class="left"><?php next_posts_link('Previous') ?></div><div class="right"><?php previous_posts_link('Next') ?></div></h2>
</div>
<?php include (TEMPLATEPATH . '/footer2.php'); ?>
</div>