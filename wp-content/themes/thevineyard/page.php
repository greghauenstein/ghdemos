<?php get_header() ?>

<?php 
	global $theme_options;
	$removesidebar = get_post_meta($post->ID, "removesidebar", true);
	$classes = get_sidebar_position_classes($removesidebar);
?>
<?php if($removesidebar != 'yes') :?>	
<div class='<?php echo $classes['sidebar'] ?> sidebar'>
	<?php  dynamic_sidebar( rf_get_sidebar($post->ID) ); ?>
</div>
<?php endif ?>

<div class='<?php echo $classes['content'] ?> single'>
	
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	
		<div class='post'>

			<?php the_post_thumbnail("post-medium") ?>
		
				
			<div class='post-content'>
				<?php the_content() ?>							
			</div>

		</div>
	
	<?php endwhile; else: ?>
	
	<h1>Something seems to be wrong!</h1>
	<p>
		This page should have some content in it but it doesn't!
	</p>
	
	<?php endif ?>

	
	
</div>

<div class="clear"></div>

<?php if(is_page('store/cart')) : ?>
	<?php get_template_part('includes/latest'); ?>
<?php endif ?>

<?php get_footer() ?>