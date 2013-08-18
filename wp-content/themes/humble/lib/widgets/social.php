<?php
/*
 * Plugin Name: Social Widget
 * Plugin URI: http://www.karimhossenbux.com
 * Description: A widget that displays social links
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossenbux.com
 */


add_action( 'widgets_init', 'hb_socials_widgets' );


function hb_socials_widgets() {
	register_widget( 'HB_Social_Widget' );
}

class HB_Social_Widget extends WP_Widget {
	
	function HB_Social_Widget() {
	
		$widget_ops = array( 'classname' => 'hb_social_widget', 'description' => __('A widget that displays your social links.', 'framework') );

		$this->WP_Widget( 'hb_social_widget', __('Humble - Social Links','framework'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$twitter = $instance['twitter'];
		$facebook = $instance['facebook'];
		$vimeo = $instance['vimeo'];
		$dribbble = $instance['dribbble'];
		$skype = $instance['skype'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		 ?>
			
			<ul>
				<li><a href="<?php echo $twitter; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico_twitter.png" alt="twitter" /></a></li>
				<li><a href="<?php echo $facebook; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico_facebook.png" alt="Facebook" /></a></li>
				<li><a href="<?php echo $vimeo; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico_vimeo.png" alt="Vimeo" /></a></li>
				<li><a href="<?php echo $dribbble; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico_dribbble.png" alt="Dribbble" /></a></li>
				<li><a href="callto://<?php echo $skype; ?>"><img src="<?php bloginfo('template_directory'); ?>/images/ico_skype.png" alt="Skype" /></a></li>
			</ul>
			<div class="clear"></div>
		<?php 

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );

		return $instance;
	}
	 
	function form( $instance ) {

		$defaults = array(
		'title' => 'Social Links',
		'twitter' => '#',
		'facebook' => '#',
		'vimeo' => '#',
		'dribbble' => '#',
		'skype' => '#'
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter Link</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $instance['twitter']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook Link</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $instance['facebook']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>">Vimeo Link</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>">Dribbble Link</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'skype' ); ?>">Skype Username</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'skype' ); ?>" name="<?php echo $this->get_field_name( 'skype' ); ?>" value="<?php echo $instance['skype']; ?>" />
		</p>
		
				
	<?php
	}
}
?>