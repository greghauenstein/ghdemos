<?php 
global $theme_options;
get_header();
?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<div class='post-content'>
		<?php the_content() ?>	
	</div>

<?php endwhile; else: ?>


	<?php if(!isset($theme_options['cp_error_title']) OR empty($theme_options['cp_error_title'])) : ?>
		<h1>Something has gone wrong!</h1>
	<?php else : ?>
		<h1><?php echo $theme_options['cp_error_title'] ?></h1>
	<?php endif ?>


	<?php if(!isset($theme_options['cp_error']) OR empty($theme_options['cp_error'])) : ?>
		<p>You either visited an incorrect link or you've found some missing content</p>			
	<?php else : ?>
		<?php echo $theme_options['cp_error'] ?>
	<?php endif ?>

<?php endif ?>



<?php get_footer() ?>