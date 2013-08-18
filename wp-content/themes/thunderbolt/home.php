<?php get_header(); ?>
<div id="content_wrapper">

<!-- This is the code for the cover image that represents your latest story, I wouldn't play too much --!>

		<div class="thunderbolt">
		<?php $top_query = new WP_Query('showposts=1'); ?>
		<?php while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID; ?>
<?php $thumb = get_post_meta($post->ID, 'Thumbnail', $single = true); $thumb_class = get_post_meta($post->ID, 'Thumbnail Class', $single = true); $thumb_alt = get_post_meta($post->ID, 'Thumbnail Alt', $single = true); ?><?php // if there's a thumbnai
if($thumb !== '') { ?>
	<img src="<?php echo $thumb; ?>" alt="<?php if($thumb_alt !== '') { echo $thumb_alt; } else { echo the_title(); } ?>" />
<?php } // end if statement

// if there's not a thumbnail
else { echo ''; } ?>
<?php endwhile; ?>
		</div>	

<!-- This is the main content, yep, lots of WP Queries --!>

		<div class="content_left">
                <div class="section_title">Most Recently</div>
		<?php $top_query = new WP_Query('showposts=1'); ?>
		<?php while($top_query->have_posts()) : $top_query->the_post(); $first_post = $post->ID; ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanently: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="meta"><b><?php the_time('Y/j') ?></b> / <?php the_category(', ') ?> / <?php comments_popup_link('No Comments', 'One Comment', '% Comments'); ?></div>
					<div class="entry">
					<?php the_excerpt_reloaded(200, '<a>', 'none', TRUE, 'More &raquo;', FALSE, 2); ?>
					</div>
                                        </div>
                                        <?php endwhile; ?>
</div>
<div class="clear"></div>
<div id="bottom_archive">
<div class="content_left_archive">
<div class="section_title">Archive View</div>
<?php query_posts('showposts=5'); ?>
		<?php while(have_posts()) : the_post(); if(!($first_post == $post->ID)) : ?>
			<div class="archive_post" id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanently: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="archive_meta"><b><?php the_time('Y/j') ?></b> / <?php the_category(', ') ?> / <?php comments_popup_link('No Comments', 'One Comment', '% Comments'); ?></div>
					<div class="archive_entry">
					<?php the_content_rss('', FALSE, '', 40); ?>
					</div>
<div class="clear"></div>
                                        </div>
<?php endif; endwhile; ?>
</div>
<div class="bottom_sidebar">
<div class="section_title">About</div>
<?php include (TEMPLATEPATH . '/sidebar.php'); ?>
</div>
</div>

<!-- For the categories --!>

<div class="clear"></div>
<div id="bottom_archive">
<div class="content_left_archive_cat">
<div class="section_title">Browse by Category</div>
<ul>
<?php wp_list_cats('sort_column=name&show_count=1'); ?>
</ul>
<div class="clear"></div>
</div>


</div>

<?php get_footer(); ?>