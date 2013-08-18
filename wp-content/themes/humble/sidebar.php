<div id="sidebar" class="grid_4">

	<?php if(!is_page()) : ?>
	
	    <?php if (!function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Main Sidebar')) : endif; ?>
	    
	<?php else: ?>
		
		<?php if (!function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar')) : endif; ?>
	    
	<?php endif; ?>
	
</div><!-- #sidebar -->