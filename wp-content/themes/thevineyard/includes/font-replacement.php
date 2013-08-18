<?php
global $theme_options;

if(!isset($theme_options['cp_title_font']) OR empty($theme_options['cp_title_font']) OR $theme_options['cp_title_font'] == "Helvetica, Arial, Sans-serif") {
	$default_stack['title'] = 'Helvetica Neue, Helvetica, sans-serif';
}

else {
	$font_sets[] = array(
		"elements"		=> "h1,h2,h3,h4,h5,h6",
		"selected"		=> $theme_options['cp_title_font'],
		"default" 		=> "Helvetica Neue, Helvetica, Arial, sans-serif",
	);
}


if(!isset($theme_options['cp_body_font']) OR empty($theme_options['cp_body_font']) OR $theme_options['cp_body_font'] == "Helvetica, Arial, Sans-serif") {
	$default_stack['body'] = 'Helvetica Neue, Helvetica, sans-serif';
}

else {
	$font_sets[] = 	array(
		"elements"		=> "body",
		"selected"		=> $theme_options['cp_body_font'],
		"default" 		=> "Helvetica Neue, Helvetica, Arial, sans-serif",
	);
}

if(isset($font_sets) AND !empty($font_sets)) :
	foreach($font_sets as $font_set) {
		$google_font_family[] = str_replace(" ", "+", $font_set["selected"]).":300";
		
		$font_degradation = (isset($font_set["selected"]) AND !empty($font_set["selected"])) 
			? $font_set["selected"].",".$font_set["default"] 
			: $font_set["selected"];
			
		$css[] = $font_set["elements"]." { font-family: $font_degradation !important}";
	}
	
	$google_font_family = implode("|", $google_font_family);
	$css = implode("\n", $css);

?>


	<link href='http://fonts.googleapis.com/css?family=<?php echo $google_font_family ?>' rel='stylesheet' type='text/css'>
	<style type="text/css">
	<?php echo $css."\n" ?>
	</style>

<?php endif ?>


<?php
	 if(isset($default_stack) AND !empty($default_stack)) :
?>

<style type="text/css">

	<?php if(isset($default_stack['cp_body_font']) AND !empty($default_stack['cp_body_font'])) : ?>
		body {
			font-family: <?php echo $default_stack['cp_body_font'] ?>
		}
	<?php endif ?>

	<?php if(isset($default_stack['cp_title_font']) AND !empty($default_stack['cp_title_font'])) : ?>
		h1,h2,h3,h4,h5,h6 {
			font-family: <?php echo $default_stack['cp_title_font'] ?>
		}	
	<?php endif ?>

</style>

<?php endif ?>


