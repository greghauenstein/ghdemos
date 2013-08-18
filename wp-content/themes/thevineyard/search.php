<?php get_header() ;

global $theme_options;
$classes = get_sidebar_position_classes();
$cart_page = Cart66Common::getPageLink('store/cart');
global $query_string;

$post_types = array("product", "post");
?>
	<div class='<?php echo $classes['sidebar'] ?> sidebar'>
		<?php  dynamic_sidebar( rf_get_sidebar($post->ID, "Store Sidebar") ); ?>
	</div>
	
	<div class='<?php echo $classes['content'] ?> last'>


<?php
foreach ($post_types as $post_type) :
	
	query_posts( $query_string.'&post_type='.$post_type );
	
	?>
	
	

	
		<?php if(have_posts()) : ?>
			<h1 class='page-sub-title'><?php echo ucfirst($post_type) ?> Results</h1>
	
			<div class="product_list section first">
			
				<?php 
					$i=0; while ( have_posts() ) : the_post();
					
					$class = ($i%2) ? "last" : "first";
					$class_last = ($i == 8 OR $i==9 ) ? "last-row" : "";
				?>
				
					<div class='product column column2x1 <?php echo $class ?> <?php echo $class_last ?>'>
						<h2><a href='<?php the_permalink() ?>'><?php echo $post->post_title ?></a></h2>
						<?php the_post_thumbnail("gallery-sb-2") ?>
						<?php if($post_type == 'product') : ?>
						<div class='price'>
						<?php 
							$item_id = get_post_meta($post->ID, 'item_id', true);
							$price = $wpdb->get_var("SELECT price FROM ".$wpdb->prefix."cart66_products WHERE id = $item_id ");
							echo "$".$price;
						?>
						</div>
						
						<a class='button yellow dark-text rounded' href='<?php echo $cart_page ?>?task=add-to-cart-anchor&cart66ItemId=<?php echo $item_id ?>'>add to cart</a>
						
						<?php endif ?>
					</div>
		
					<?php if($i%2) : ?>
						<div class="clear"></div>
					<?php endif ?>
					
				<?php $i++; endwhile ; ?>
				
			</div>
		
			<?php else : ?>
			
				<?php if($post_type == "post") : ?>
				<h1 class='page-sub-title nomargin'>No blog posts found</h1>
				<p>There are no blog posts which match your query</p>
				
				<?php else :?>
				<h1 class='page-sub-title nomargin'>No products found</h1>
				<p>There are no products which match your query</p>
				
				<?php endif ?>
				
				
				
			<?php endif ?>
	<div class="clear"></div>
	
	<?php endforeach ?>


			<?php nicepagination($latest) ?>

	</div>
	
	<div class="clear"></div>
	

<?php get_footer() ?>