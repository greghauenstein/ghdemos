<?php get_header(); ?>

	<div id="main-holder">
	
	<h1 class="big-title"><?php the_title(); ?></h1>
	<?php if (of_get_option('breadcrumb') == '1') { ?>
	<div id="breadcrumb" class="grid_12 omega alpha">
		<?php hb_breadcrumbs() ?>
	</div>
	<?php } ?>

		<div id="main" class="grid_<?php echo (of_get_option('portfolio_layout', 'fullwidth') == 'fullwidth' ? '12' : '8'); ?>">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			
					<div id="post_content" class="<?php echo of_get_option('portfolio_layout', 'fullwidth'); ?>">
					
						<div class="meta">
							<?php if (of_get_option('portfolio_date') == '1') { ?>
								<span class="date">Date: <?php the_time('F Y'); ?></span>
							<?php } ?>
							<?php if (of_get_option('portfolio_comment') == '1') { ?>
								<span class="comment"><?php comments_popup_link('No comments', '1 Comment', '% Comments'); ?></span>
							<?php } ?>
						</div>
					
					<?php
					if (has_post_thumbnail()) {
						$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$thumb_object = get_post($post_thumbnail_id);
						$thumb = $thumb_object->guid;
					}
					?>
					
					<?php the_content(); ?>
					</div>
					<?php if (of_get_option('portfolio_comment') == '1') { ?>
						<?php comments_template('', true); ?>
					<?php } ?>
					
				<?php endwhile; ?>
			<?php endif; ?>
						
		</div>
		<?php if (of_get_option('portfolio_layout', 'fullwidth') != 'fullwidth') { ?>
			<?php get_sidebar(); ?>
		<?php } ?>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>