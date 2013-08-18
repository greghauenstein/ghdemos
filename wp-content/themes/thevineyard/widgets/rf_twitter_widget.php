<?php
/*
 * Plugin Name: Custom twitter widget
 * Plugin URI: http://www.redfactory.nl
 * Description: A widget that displays the latest tweet of a user
 * Version: 1.0
 * Author: Red Factory
 * Author URI: http://www.redfactory.nl
 */



// Register widget
function rf_twitter_widget() {
	register_widget( 'rf_twitter_widget' );
}
add_action( 'widgets_init', 'rf_twitter_widget' );

// Widget class
class rf_twitter_widget extends WP_Widget {

	function rf_twitter_widget() {
		if (!is_admin()) {
			wp_register_style('tweetstyle', get_template_directory_uri().'/widgets/rf_twitter_widget.css', array('style'));
			wp_enqueue_style('tweetstyle');
			wp_register_script('tweet', get_template_directory_uri().'/js/jquery.tweet.js', array('jquery'));
			wp_enqueue_script('tweet');
		}
	
		$widget_ops = array( 'classname' => 'rf_twitter_widget', 'description' => 'A widget that displays the latest tweet of a user.');
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'rf_twitter_widget' );
		$this->WP_Widget( 'rf_twitter_widget', 'Custom Twitter Widget', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );

		// Our variables from the widget settings
		$title_markup = apply_filters('widget_title', $instance['title'] );
		$title = $instance['title'];
		$username = str_replace('@','',$instance['username']);

		?><script type="text/javascript">
        jQuery(document).ready(function($){
            $(".rf_twitter_widget.username-<?php echo $username; ?> .tweet:not(.active)").each(function(){
				$(this).tweet({
					username: "<?php echo $username; ?>",
					join_text: null,
					avatar_size: null,
					count: 1,
					auto_join_text_default: "",
					auto_join_text_ed: "",
					auto_join_text_ing: "",
					auto_join_text_reply: "",
					auto_join_text_url: "",
					loading_text: "loading tweets..."
				}).addClass('active');
            });
        });
        </script><?php

		// Before widget (defined by themes)
		echo $before_widget;

		// Display the widget title if one was input (before and after defined by themes)
		if ($title) echo $before_title . $title_markup . $after_title;
			
		// Display a containing div
		echo '<div class="rf_twitter_widget username-'.$username.'">
			<div class="tweet"></div>
			<div class="arrow-container">
				<div class="arrow-border"></div>
				<div class="arrow"></div>
			</div>
			<div class="follow">
				<img src="'.get_bloginfo('template_directory').'/images/twitterbird.png" />
				<a class="button yellow dark-text" href="http://www.twitter.com/'.$username.'" target="_BLANK">follow on Twitter....</a>
			</div>
		</div>';

		// After widget (defined by themes)
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['username'] = $new_instance['username'];
		
		return $instance;
	}
	
	
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array();
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Username:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
	<?php
	}
}
?>