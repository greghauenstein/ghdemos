<?php 
/*
Template Name: Store Page
*/
global $theme_options;
get_header();
$classes = get_sidebar_position_classes();
$removesidebar = get_post_meta($post->ID, "removesidebar", true);
$classes = get_sidebar_position_classes($removesidebar);
?>

<?php global $theme_options; $cart_page = Cart66Common::getPageLink('store/cart'); ?>

<?php if($removesidebar != 'yes') :?>	
<div class='<?php echo $classes['sidebar'] ?> sidebar'>
	<?php  dynamic_sidebar( rf_get_sidebar($post->ID, "Store Sidebar") ); ?>
</div>
<?php endif ?>

<div class='<?php echo $classes['content'] ?>'>

	<?php if(isset($theme_options['cp_latest_title']) AND !empty($theme_options['cp_latest_title'])) : ?>
		<h1 class='page-sub-title'><?php echo $theme_options['cp_latest_title'] ?></h1>
	<?php endif ?>

	<div class="product_list section first">
	
		<?php 
			$per_page = get_post_meta($post->ID, "product_count", true);
			$per_page = (!isset($per_page) OR empty($per_page)) ? 10 : $per_page;
			
			$excludes = get_post_meta($post->ID, "exclude-categories-store", true);
			$excludes = explode(",",$excludes );
	
			$latest = new WP_Query( array(
				"paged" => $paged,
				"post_type" => "product",
				"post_status" => "publish",
				"posts_per_page" => $per_page,
				"meta_key" => "item_id",
				'tax_query' => array(
					array(
						'taxonomy' => 'product_categories',
						'field' => 'id',
						'terms' => $excludes,
						'operator' => 'NOT IN',
					)
				)
			) );
	
	
			$i=0; while ( $latest->have_posts() ) : $latest->the_post();
			
			$class = ($i%2) ? "last" : "first";
			$class_last = ($i == 8 OR $i==9 ) ? "last-row" : "";
		?>
		
			<div class='product column column2x1 <?php echo $class ?> <?php echo $class_last ?>'>
				<h2><a href='<?php the_permalink() ?>'><?php echo $post->post_title ?></a></h2>
				<?php 
					$image_size = ($removesidebar == "yes") ? "gallery-nosb-2" : "gallery-sb-2";
					the_post_thumbnail($image_size) 
				?>
				<div class='price'>
				<?php 
					$item_id = get_post_meta($post->ID, 'item_id', true);
					$price = $wpdb->get_var("SELECT price FROM ".$wpdb->prefix."cart66_products WHERE id = $item_id ");
					echo "$".$price;
				?>
				</div>
				
				<a class='button yellow dark-text rounded' href='<?php echo $cart_page ?>?task=add-to-cart-anchor&cart66ItemId=<?php echo $item_id ?>'>add to cart</a>
			</div>

			<?php if($i%2) : ?>
				<div class="clear"></div>
			<?php endif ?>
			
		<?php $i++; endwhile ?>
		
	
	</div>
	<div class='clear'></div>
	<?php nicepagination($latest) ?>

</div>

<div class="clear"></div>



<?php get_footer() ?>