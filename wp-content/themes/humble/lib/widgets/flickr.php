<?php
/*
 * Plugin Name: Flickr Widget
 * Plugin URI: http://www.karimhossenbux.com
 * Description: Display photos from your Flickr
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossenbux.com
 */


add_action( 'widgets_init', 'hb_flickr_widgets' );


function hb_flickr_widgets() {
	register_widget( 'HB_FLICKR_Widget' );
}

class hb_flickr_widget extends WP_Widget {
	
	function HB_FLICKR_Widget() {
	
		$widget_ops = array( 'classname' => 'hb_flickr_widget', 'description' => 'Display your Flickr photos.' );

		$this->WP_Widget( 'hb_flickr_widget', 'Humble - Flickr Photos', $widget_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$postcount = $instance['postcount'];
		$type = $instance['type'];
		$display = $instance['display'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

?>
			
			<div class="flickr">
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
			</div>
			
			<div class="clear"></div>
		
<?php
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}
		 
	function form( $instance ) {

		$defaults = array(
		'title' => 'Flickr Widget',
		'flickrID' => '26608681@N05',
		'postcount' => '6',
		'type' => 'user',
		'display' => 'random',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>">Flickr ID: (<a href="http://idgettr.com/" target="_blank">idGettr</a>)</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of photos:</label>
			<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
            	<optgroup label="Footer">
                    <option <?php if ( '3' == $instance['postcount'] ) echo 'selected="selected"'; ?>>3</option>
                    <option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
                    <option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
                </optgroup>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Type (user or group):</label>
			<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
				<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
				<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>">Display (random or latest):</label>
			<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
				<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
				<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
			</select>
		</p>
		
	<?php
	}
}
?>