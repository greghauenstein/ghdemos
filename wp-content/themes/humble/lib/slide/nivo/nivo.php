<div id="nivo" class="nivoSlider">
	<?php
	$args = array(
		'post_type' => 'slide',
		'posts_per_page' => -1,
		'orderby' => 'menu_order'
	); 
	$slide_query = new WP_Query($args);
	?>
	<?php while ( $slide_query->have_posts() ) : $slide_query->the_post(); ?>
		<?php
		$image = get_post_meta(get_the_ID(), '_hb_slide_image', false);
		$image = $image[0];
		$link = get_post_meta(get_the_ID(), '_hb_slide_link', true);
		$caption = get_post_meta(get_the_ID(), '_hb_slide_caption', true);
		?>
	    <a href="<?php echo $link?>"><img src="<?php bloginfo('template_directory') ?>/timthumb.php?q=100&w=650&h=350&src=<?php echo $image; ?>" title="<?php echo $caption ?>" /></a>
	<?php endwhile; ?>
    
</div>

<?php if (of_get_option('slider_texture')) { ?>
<div id="texture"></div>
<?php } ?>

