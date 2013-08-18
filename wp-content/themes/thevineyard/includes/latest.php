<?php global $theme_options; $cart_page = Cart66Common::getPageLink('store/cart'); ?>

<div class="product_list section widget">
	<h1><?php echo $theme_options['cp_latest_title'] ?></h1>

	<?php 
			$excludes = $theme_options['cp_blog_category'];
			if(isset($excludes) AND !empty($excludes)) {	
				$excludes = "-".implode(",-",$excludes);
			}
			$latest = new WP_Query( "paged=".$paged."&post_type=product&post_status=publish&posts_per_page=3&meta_key=item_id" );
		$i=0; while ( $latest->have_posts() ) : $latest->the_post();
		
		$class_first = ($i==0) ? "first" : "";
		$class_last = ($i==2) ? "last" : "";
	?>
	
		<div class='product column column3x1 <?php echo $class_first ?> <?php echo $class_last ?>'>
			<h2><a href='<?php the_permalink() ?>'><?php echo $post->post_title ?></a></h2>
			<?php the_post_thumbnail("gallery-nosb-3") ?>
			<div class='clear'></div>
			<div class='price'>
			<?php 
				$item_id = get_post_meta($post->ID, 'item_id', true);
				$price = $wpdb->get_var("SELECT price FROM ".$wpdb->prefix."cart66_products WHERE id = $item_id ");
				echo "$".$price;
			?>
			</div>
			
			<a class='button yellow dark-text rounded add-to-cart' href='<?php echo $cart_page ?>?task=add-to-cart-anchor&cart66ItemId=<?php echo $item_id ?>'>add to cart</a>
		</div>
		
	<?php $i++; endwhile ?>
	
	<div class="clear"></div>

</div>

