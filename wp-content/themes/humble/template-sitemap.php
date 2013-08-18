<?php
/*
Template Name: Sitemap
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

		<div id="main" class="grid_8">
			
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
			
					<div id="page_content" class="sitemap">
						
						<div class="one_half">
							<h6>Last 20 Posts:</h6>
							<ul>
							<?php $archive = get_posts('numberposts=20');
							foreach($archive as $post) : ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							<?php endforeach; ?>
							</ul>
							<h6>Last 20 Portfolio Items:</h6>
							<ul>
							<?php $portfolio = get_posts('numberposts=20&post_type=portfolio');
							foreach($portfolio as $post) : ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
							<?php endforeach; ?>
							</ul>
						</div>
											
						<div class="one_halt last">
							<h6>Archives by Month:</h6>
							<ul>
								<?php wp_get_archives('type=monthly'); ?>
							</ul>
							<h6>Archives by Subject:</h6>
							<ul>
						 		<?php wp_list_categories( 'title_li=' ); ?>
							</ul>
						</div>
						
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
						
		</div>
		
		<?php get_sidebar(); ?>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>