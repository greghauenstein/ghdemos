<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>

	<div id="main-holder">
	
	<h1 class="big-title"><?php the_title(); ?></h1>
	<?php if (of_get_option('breadcrumb') == '1') { ?>
	<div id="breadcrumb" class="grid_12 omega alpha">
		<?php hb_breadcrumbs() ?>
	</div>
	<?php } ?>

		<div id="main" class="grid_12">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			
					<div id="page_content" class="fullwidth contact">
						<div class="one_half">
							<?php the_content(); ?>
						</div>
						<div class="one_half last">
							<?php echo of_get_option('contact_message'); ?>
							<div class="two_third">
								<h6>Address:</h6>
								<p><?php echo of_get_option('contact_address'); ?></p>
							</div>
							<div class="one_third last">
								<h6>Phone:</h6>
								<p><?php echo of_get_option('contact_phone'); ?></p>
							</div>
							<div class="clear"></div>
						</div>
						
						<?php echo do_shortcode(of_get_option('contact_map')); ?>
										
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
						
		</div>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>