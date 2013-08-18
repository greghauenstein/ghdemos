<?php
/*
Template Name: Blog Page
*/
?>
<?php get_header() ;

global $theme_options;
$removesidebar = get_post_meta($post->ID, "removesidebar", true);
$classes = get_sidebar_position_classes($removesidebar);
	
$excludes = get_post_meta($post->ID, "exclude-categories-blog", true);
if(isset($includes) AND !empty($includes)) {	
	query_posts( 'cat='.$includes );
}

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
			<h2><a href='<?php the_permalink() ?>'><?php echo $post->post_title ?></a></h2>
			
			<div class='post-content'>
				<?php the_excerpt() ?>
				
				<a href='<?php the_permalink() ?>'>read more</a>
				
				<div class='post-meta'>
					<div class='meta column column4x1 first'>
						<img src='<?php echo get_template_directory_uri() ?>/images/icon_author.png'> <?php the_author_posts_link(); ?>
					</div>
					<div class='meta column column4x1'>
						<img src='<?php echo get_template_directory_uri() ?>/images/icon_date.png'> <?php the_time("M j, Y") ?>
					</div>
					<div class='meta column column4x1'>
						<img src='<?php echo get_template_directory_uri() ?>/images/icon_category.png'> <?php the_category(", ") ?>
					</div>
					<div class='meta column column4x1 last'>
						<img src='<?php echo get_template_directory_uri() ?>/images/icon_comment.png'> <a href='<?php comments_link(); ?>'><?php comments_number() ?></a>
					</div>
					<div class='clear'></div>
				</div>
				
			</div>
		</div>
	
	<?php endwhile; else: ?>
	
	<h1>Something seems to be wrong!</h1>
	<p>
		This page should have some content in it but it doesn't!
	</p>
	
	<?php endif ?>

	
	
	<?php nicepagination($latest) ?>

</div>

<div class="clear"></div>

	
		
<?php get_footer(); ?>
