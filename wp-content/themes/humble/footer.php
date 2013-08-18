		
		<?php
		$footer_cols = of_get_option('footer_cols', '4');
		$cols = array('3' => 'grid_4', '4' => 'grid_3');
		?>
		
		<div id="footer">
			
			<div class="<?php echo $cols[$footer_cols]; ?>">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 1')) ?>
			</div>
			
			<div class="<?php echo $cols[$footer_cols]; ?>">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 2')) ?>
			</div>
			
			<div class="<?php echo $cols[$footer_cols]; ?>">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 3')) ?>
			</div>
			
			<?php if ($footer_cols == '4') { ?>
			<div class="<?php echo $cols[$footer_cols]; ?>">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer 4')) ?>
			</div>
			<?php } ?>
			
			<div class="clear"></div>
			
			<div id="copyright" class="<?php echo of_get_option('footer_copyright_text_align'); ?>">
				<?php echo of_get_option('footer_copyright', 'Humble © 2011. All right reserved.'); ?>
			</div>
			
		</div><!-- #footer -->

	</div><!-- #wrapper -->

</body>
</html>