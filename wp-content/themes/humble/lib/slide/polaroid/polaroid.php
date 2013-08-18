<div id="polaroid">
	<?php
	$args = array(
		'post_type' => 'slide',
		'posts_per_page' => 10,
		'orderby' => 'menu_order'
	); 
	$slide_query = new WP_Query($args);
	$i = 1;
	?>
	<div id="loading"></div>
	<div id="big">
		<div id="altern"></div>
	</div>
	<?php if (of_get_option('slider_texture')) { ?>
	<div id="texture"></div>
	<?php } ?>
	<div id="thumbs">
		<?php while ( $slide_query->have_posts() ) : $slide_query->the_post(); ?>
			<?php
			$image = get_post_meta(get_the_ID(), '_hb_slide_image', false);
			$image = $image[0];
			$link = get_post_meta(get_the_ID(), '_hb_slide_link', true);
			$caption = get_post_meta(get_the_ID(), '_hb_slide_caption', true);
			?>
			<div class="thumb" id="t<?php echo $i; ?>">
				<img src="<?php bloginfo('template_directory') ?>/timthumb.php?q=100&w=100&src=<?php echo $image; ?>" alt="<?php bloginfo('template_directory') ?>/timthumb.php?q=100&w=650&h=350&src=<?php echo $image; ?>" />
			</div>
			<?php $i++; ?>
		<?php endwhile; ?>
	</div>
	<div class="clearfix"></div>
</div>