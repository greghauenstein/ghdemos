<?php
/*
 * Plugin Name: Latest Tweets
 * Plugin URI: http://www.karimhossenbux.com
 * Description: A widget that displays your latest tweets
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossnebux.com
 */


add_action( 'widgets_init', 'hb_tweets_widgets' );


function hb_tweets_widgets() {
	register_widget( 'HB_Tweet_Widget' );
}

class hb_tweet_widget extends WP_Widget {
	
	function HB_Tweet_Widget() {
	
		$widget_ops = array( 'classname' => 'hb_tweet_widget', 'description' => __('A widget that displays your latest tweets.', 'framework') );

		$this->WP_Widget( 'hb_tweet_widget', __('Humble - Latest Tweets','framework'), $widget_ops );
	}

	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$postcount = $instance['postcount'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
		 ?>

            <ul id="twitter_update_list" class="twitter">
                <li><p></p></li>
            </ul>
            
            <a href="http://twitter.com/<?php echo $username ?>" class="twitter-link"></a>
			<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
			<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $username ?>.json?callback=twitterCallback2&amp;count=<?php echo $postcount ?>"></script>
                            
            <div class="twitter_bird"></div>
		
		<?php 

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );

		return $instance;
	}
	 
	function form( $instance ) {

		$defaults = array(
		'title' => 'Latest Tweets',
		'username' => 'karimhossenbux',
		'postcount' => '2'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter Username e.g. karimhossenbux</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of tweets (max 20)</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
		
	<?php
	}
}
?>