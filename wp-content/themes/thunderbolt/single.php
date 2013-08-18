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
}

?></div>
<div class="content_left_single">
		<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
<div class="single_right_sidebar">
<h3>Information</h3>
<p>Article written on <?php the_time('F jS, Y') ?></p>
<p>Archived into <?php the_category(', ') ?></p>
<p>Public Ranking: <?php comments_number('0', '1', '%' );?></p>

<div class="single_thunderbolt"><?php $thumb = get_post_meta($post->ID, 'Thumbnail', $single = true); $thumb_class = get_post_meta($post->ID, 'Thumbnail Class', $single = true); $thumb_alt = get_post_meta($post->ID, 'Thumbnail Alt', $single = true); ?><?php // if there's a thumbnai
if($thumb !== '') { ?>
	<img src="<?php echo $thumb; ?>" alt="<?php if($thumb_alt !== '') { echo $thumb_alt; } else { echo the_title(); } ?>" />
<?php } // end if statement
// if there's not a thumbnail
else { echo ''; } ?>
</div>
</div>
			<div class="single_post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanently: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<div class="single_entry">
					<?php the_content('[...]'); ?>
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
<div id="comments_wrapper">
<?php comments_template(); ?>
</div>
</div>
<?php include (TEMPLATEPATH . '/footer2.php'); ?>
</div>