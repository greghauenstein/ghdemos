<?php 
/*
Template Name: Home Page
*/
global $theme_options;
get_header();
?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

	<div class='post-content'>
		<?php the_content() ?>	
	</div>

<?php endwhile; else: ?>

<h1>Something seems to be wrong!</h1>
<p>
	This page should have some content in it but it doesn't!
</p>

<?php endif ?>

<?php if(isset($theme_options["cp_callout_section"]) AND !empty($theme_options["cp_callout_section"])) : ?>
<div class='full callout-section'>
	<div class='inner post-content'>
		<?php
			$callout = get_post($theme_options["cp_callout_section"]);
			$content = apply_filters('the_content', $callout->post_content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo $content;
		?>
	</div>
</div>
<?php endif ?>

<?php get_template_part("includes/latest") ?>

<?php addthis_widget() ?>

<?php get_footer() ?>