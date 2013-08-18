<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>

		<div id="main-holder">
			
			<div id="slide">
				
				<div id="sleft" class="grid_4 alpha omega">
					<h1><?php echo of_get_option('slogan_h1'); ?></h1>
					
					<h2><?php echo of_get_option('slogan_h2'); ?></h2>
				</div>
				
				<?php
				$slider = of_get_option('slider');
				$demo_polaroid = get_post_meta(get_the_ID(), 'demo_polaroid', true);
				if ($demo_polaroid == '1') $slider = 'polaroid';
				?>
				
				<div id="sright" class="grid_8 alpha omega" style="position:relative;">
					<?php if ($slider == 'nivo_slider') : ?>
						<?php require_once(LIBPATH . 'slide/nivo/nivo.php'); ?>
					<?php elseif ($slider == 'polaroid') : ?>
						<?php require_once(LIBPATH . 'slide/polaroid/polaroid.php'); ?>
					<?php endif; ?>
				</div>
				
			</div>
			
			<div class="clear"></div>
			<div id="home_content">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php $tmp = $post->post_content; ?>
					<?php if (strpos($tmp, '[tabs') === false) echo '<div class="notabs">'; ?>
						<?php the_content(); ?>
					<?php if (strpos($tmp, '[tabs') === false) echo '</div>'; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			</div>
			
		</div><!-- #main-holder .container_12-->
	

<?php get_footer(); ?>
