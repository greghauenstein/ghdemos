<?php get_header(); ?>

	<div id="main-holder">
	
	<h1 class="big-title"><?php the_title(); ?></h1>
	<?php if (of_get_option('breadcrumb') == '1') { ?>
	<div id="breadcrumb" class="grid_12 omega alpha">
		<?php hb_breadcrumbs() ?>
	</div>
	<?php } ?>

		<div id="main" class="grid_8">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			
					<div id="post_content">
					
						<div class="meta">
							<?php if (of_get_option('meta_date') == '1') { ?>
								<span class="date">Posted on <?php the_time(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></span>
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
							<img src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&h=200&w=600&zc=1&q=100" />
						</div>
					<?php
					}
					?>
					
					<?php the_content(); ?>
					</div>
					
					<?php comments_template('', true); ?>
					
				<?php endwhile; ?>
			<?php endif; ?>
						
		</div>
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>