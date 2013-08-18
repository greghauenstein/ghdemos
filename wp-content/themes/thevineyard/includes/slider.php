<?php global $theme_options; $slides = new WP_Query( array( 'post_type' => 'slide', 'posts_per_page' => -1 ) );

if ($slides->have_posts()) { ?>

<div id="slides" data-fade='<?php echo $theme_options['cp_slider_fade'] ?>' data-speed='<?php echo $theme_options['cp_slider_speed'] ?>' data-pause='<?php echo $theme_options['cp_slider_pause'] ?>'>
	
    <div class="slides_container">

        <?php while ( $slides->have_posts() ) : $slides->the_post();

				$image_id = get_post_thumbnail_id($slides->ID);
				$image = wp_get_attachment_image_src($image_id, "slider-image");				
			?>
            	<div class="slide">									
					<div class='slide-container'>
						<?php 
							$titlelocation = get_post_meta($post->ID, "titlelocation", true); 
							if(!isset($titlelocation) OR empty($titlelocation))	{$titlelocation = "left";}
							$titlelocation = strtolower($titlelocation);		
							if($titlelocation != "don't display"):			
						?>
						<div class="page-title <?php echo $titlelocation ?>">
							<div class="page-title-bg"></div>
							<h1><?php the_title() ?></h1>	
							
							<?php 
								$buttontext = get_post_meta($post->ID, "buttontext", true);
								$buttonurl = get_post_meta($post->ID, "buttonurl", true);

								if($buttontext AND $buttonurl):
							?>
								<a class='button yellow dark-text' href='<?php echo $buttonurl ?>'><?php echo $buttontext ?></a>
							<?php endif ?>
							
											
						</div>
						
						<?php endif ?>
						
	   					<img class="slide-image" src="<?php echo $image[0] ?>">

						<?php 
							$contentalign = get_post_meta($post->ID, "contentalign", true); 
							if(!isset($contentalign) OR empty($contentalign)) {$contentalign = "right";}
							$contentalign = strtolower($contentalign);		
						?>	   					
						<div class="slide_content <?php echo $contentalign ?>">
		
							<?php the_content() ?>
							
	           			</div>
	           		</div>
               		
                </div>


        <?php endwhile; ?>

    </div>

</div>

<?php } ?>