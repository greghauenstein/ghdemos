<?php get_header() ; ?>

<?php 
	global $theme_options;
	$classes = get_sidebar_position_classes();
$removesidebar = get_post_meta($pageid, "removesidebar", true);
?>


<?php if($removesidebar != 'yes') :?>	
<div class='<?php echo $classes['sidebar'] ?> sidebar'>
	<?php  dynamic_sidebar( rf_get_sidebar($post->ID, "Store Sidebar") ); ?>
</div>
<?php endif ?>

<div class='<?php echo $classes['content'] ?>'>
	
	<?php 
		if(have_posts()) : while(have_posts()) : the_post(); 
		$cart_page = Cart66Common::getPageLink('store/cart');	
		$item_id = get_post_meta($post->ID, 'item_id', true);
		
		$price = $wpdb->get_var("SELECT price FROM ".$wpdb->prefix."cart66_products WHERE id = $item_id ");
	?>
	
		<div class='product single'>
			<h1><?php echo $post->post_title ?></h1>
			
			<div class='column5x2 first column'>
				<?php the_post_thumbnail("post-small") ?>
				<div class='clear'></div>
				<div class='price'>$<?php echo $price ?></div>
				<a class='button yellow dark-text rounded add-to-cart' href='<?php echo $cart_page ?>?task=add-to-cart-anchor&cart66ItemId=<?php echo $item_id ?>'>add to cart</a>
			</div>
		
			<div class='post-content column column5x3 last'>
				<?php the_content() ?>		
				
				
				<?php 
					$tags = get_the_tags();
					if(!empty($tags)) :	
				?>
				
				<div class='tags section-box'>
					<h3>Tags</h3>
					<?php foreach ($tags as $tag): ?>
					<a href='<?php echo get_tag_link($tag->term_id) ?>' class='tag'><?php echo $tag->name ?><span class='flag'></span></a>
					<?php endforeach ?>
				</div>
							
				
				<?php endif ?>
				
				
				<?php addthis_widget() ?>

							
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

<?php get_template_part("includes/latest") ?>

<?php get_footer() ?>