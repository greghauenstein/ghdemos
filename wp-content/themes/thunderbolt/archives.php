<?php
/*
Template Name: Archives
*/
?>
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
		<?php $top_query = new WP_Query('showposts=30'); ?>
		<?php while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID; ?>
<div class="archive_float"><?php $thumb = get_post_meta($post->ID, 'Thumbnail', $single = true); $thumb_class = get_post_meta($post->ID, 'Thumbnail Class', $single = true); $thumb_alt = get_post_meta($post->ID, 'Thumbnail Alt', $single = true); ?><?php // if there's a thumbnai
if($thumb !== '') { ?>
	<img src="<?php echo $thumb; ?>" alt="<?php if($thumb_alt !== '') { echo $thumb_alt; } else { echo the_title(); } ?>" />
<?php } // end if statement

// if there's not a thumbnail
else { echo '<div class="overcontent"></div>'; } ?>
<div class="archive_meta_overlay"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanently: <?php the_title(); ?>"><?php the_time('F d, Y') ?></a></div>
</div>
<?php endwhile; ?>
<?php include (TEMPLATEPATH . '/footer2.php'); ?>
</div>
</div>