<?php
/*
Template Name: Left Sidebar
*/

get_header();

?>

	<div id="main-holder">
	
	<h1 class="big-title"><?php the_title(); ?></h1>
	<?php if (of_get_option('breadcrumb') == '1') { ?>
	<div id="breadcrumb" class="grid_12 omega alpha">
		<?php hb_breadcrumbs() ?>
	</div>
	<?php } ?>

		<?php get_sidebar(); ?>
		
		<div id="main" class="grid_8">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			
					<div id="page_content" class="left_sidebar">
					<?php the_content(); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
						
		</div>
		
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>