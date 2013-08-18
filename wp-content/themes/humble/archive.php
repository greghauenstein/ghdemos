<?php get_header(); ?>

	<div id="main-holder">
	
	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="big-title"><?php printf('All posts in %s', single_cat_title('',false)); ?></h1>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="big-title"><?php printf('All posts tagged %s', single_tag_title('',false)); ?></h1>
	<?php /* If this is a daily archive */ } else if (is_day()) { ?>
		<h1 class="big-title"><?php echo 'Archive for'; ?> <?php the_time('F jS, Y'); ?></h1>
	 <?php /* If this is a monthly archive */ } else if (is_month()) { ?>
		<h1 class="big-title"><?php echo 'Archive for'; ?> <?php the_time('F, Y'); ?></h1>
	<?php /* If this is a yearly archive */ } else if (is_year()) { ?>
		<h1 class="big-title"><?php echo 'Archive for'; ?> <?php the_time('Y'); ?></h1>
	<?php /* If this is an author archive */ } else if (is_author()) { ?>
		<h1 class="big-title"><?php echo 'All posts by'; ?> <?php echo $curauth->display_name; ?></h1>
	<?php /* If this is a post type archive */ } else if (is_post_type_archive('portfolio')) { ?>
		<h1 class="big-title"><?php echo 'All my Portfolio'; ?></h1>
	<?php /* If this is a paged archive */ } else if (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="big-title"><?php echo 'Blog Archives'; ?></h1>
	<?php } ?>

	<?php if (of_get_option('breadcrumb') == '1') { ?>
	<div id="breadcrumb" class="grid_12 omega alpha">
		<?php hb_breadcrumbs() ?>
	</div>
	<?php } ?>

		<div id="main" class="grid_8 archives">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="entry" id="post-<?php the_ID(); ?>">
						<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<div class="meta">
							<?php if (of_get_option('meta_date') == '1') { ?>
								<span class="date">Posted on <?php the_time(get_option('date_format')); ?> @ <?php the_time('g:ia'); ?></span>
							<?php } ?>
							<?php if (of_get_option('meta_author') == '1') { ?>
								by <span class="author"><?php the_author(); ?></span>
							<?php } ?>
							<span class="comment"><?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?></span>
						</div>
						<?php
						if (has_post_thumbnail()) {
							$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
							$thumb_object = get_post($post_thumbnail_id);
							$thumb = $thumb_object->guid;
						?>
							<div class="thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&h=100&w=600&zc=1&q=100" alt="<?php the_title(); ?>" /></a>
							</div>
						<?php
						}
						?>
						<div class="excerpt">
							<?php the_excerpt(); ?>
							<div class="more">
								<a class="button white" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">&raquo; Read more</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
			
			<?php hb_pagination(); ?>
			
		</div>
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>