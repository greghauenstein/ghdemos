<?php get_header(); ?>

	<div id="main-holder">
	
		<h1 class="big-title"><?php printf('Search Results for %s', '<span>' . get_search_query() . '</span>' ); ?></h1>

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
				
			<?php else: ?>
				<div class="nothing-found">
					<div class="error">
						<div class="message_box_content center">
							Sorry, but no posts were found. Use the search form again to find what you are looking for.
						</div>
					</div>
				</div>
				
			<?php endif; ?>
			
			<?php hb_pagination(); ?>
			
		</div>
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>