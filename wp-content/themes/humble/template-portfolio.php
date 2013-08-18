<?php
/*
Template Name: Portfolio
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
			
			<div id="portfolio">
			
				<div id="filters">
					<?php $categories = get_terms('portfolio_category'); ?>
					<?php $checklast = $categories; ?>
					
					<a class="white button left <?php echo (!isset($_GET['view'])) ? 'current' : ''; ?>" href="<?php the_permalink(); ?>" title="View all items">All</a><?php foreach ($categories as $category) : ?><?php $lastone = next($checklast) === false; ?><a class="white button <?php echo (!$lastone) ? 'middle' : 'right'; ?> <?php echo (isset($_GET['view']) && $_GET['view'] == $category->slug) ? 'current' : ''; ?>" href="<?php the_permalink(); ?>?view=<?php echo $category->slug; ?>" title="View all items in <?php echo $category->name; ?>"><?php echo $category->name; ?></a><?php endforeach; ?>
					
				</div>
			
			<?php
			//array cols
			$cols = array('1' => 'two_third', '2' => 'one_half', '3' => 'one_third', '4' => 'one_fourth');
			$img_w = array('1' => '590', '2' => '430', '3' =>'270', '4' => '195');
			$img_h = array('1' => '240', '2' => '200', '3' =>'140', '4' => '100');
			$posts_per_page = array('1' => '4', '2' => '6', '3' =>'9', '4' => '12');

			$portfolio_cols = get_post_meta($post->ID, '_hb_portfolio_cols', true);
			$demo = get_post_meta($post->ID, 'demo_portfolio', true);
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			$args = array(
				'post_type' => 'portfolio',
				'paged' => $paged,
				'posts_per_page' => $posts_per_page[$portfolio_cols]
			);
			
			if (isset($_GET['view'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => $_GET['view']
					)
				);
			}
			
			?>
			
			<?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
			
			<?php query_posts($args); ?>
			<?php if (have_posts()) : ?>
				<?php $i = 1; ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php
					if (has_post_thumbnail()) {
						$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$thumb_object = get_post($post_thumbnail_id);
						$thumb = $thumb_object->guid;
					} else {
						$thumb = get_bloginfo('template_directory') . '/images/portfolio-default.png';
					}
					?>	
						<?php if ($portfolio_cols == 1) : ?>
						<div class="one_third one_col">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="project_desc">
								<?php
								$desc = get_post_meta(get_the_ID(), '_hb_project_desc', true);
								echo $desc;
								?>
							</div>
							<div class="meta">
								<span class="time"><?php the_time('F Y') ?></span>
								<?php $taxonomy = wp_get_object_terms($post->ID, 'portfolio_category'); ?>
								<span class="category"><?php echo $taxonomy[0]->name; ?></span>
							</div>
						</div>
						<?php endif; ?>
						<div class="<?php echo $cols[$portfolio_cols]; ?><?php if ($i%$portfolio_cols == 0) echo ' last'; ?>">
							<?php if (of_get_option('portfolio_title') == '1' || $demo == '1') { ?>
							<h3 class="mini_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php } ?>
							<div class="thumbnail" style="background-image: url(<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo $thumb; ?>&h=<?php echo $img_h[$portfolio_cols]; ?>&w=<?php echo $img_w[$portfolio_cols]; ?>&zc=1&q=100);">
								<a class="overlay" href="<?php the_permalink(); ?>"></a>
								<?php if ($portfolio_cols != 1) : ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="meta">
									<span class="time"><?php the_time('F Y') ?></span>
									<?php $taxonomy = wp_get_object_terms($post->ID, 'portfolio_category'); ?>
									<span class="category"><?php echo $taxonomy[0]->name; ?></span>
								</div>
								<?php endif; ?>
							</div>
							<?php if (of_get_option('portfolio_desc') == '1' || $demo == '1') { ?>
								<p class="desc"><?php echo get_post_meta(get_the_ID(), '_hb_project_desc', true); ?></p>
							<?php } ?>
						</div>
					<?php
						$i++;
					?>
			
				<?php endwhile; ?>
			<?php endif; ?>
				<div class="clear"></div>
				
				<?php hb_pagination(); ?>
				
			</div>
						
		</div>
		
		<div class="clear"></div>
		
	</div>

<?php get_footer(); ?>