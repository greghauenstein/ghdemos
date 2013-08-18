<?php
/*
 * Plugin Name: Custom Latest Post
 * Plugin URI: http://www.karimhossenbux.com
 * Description: A widget recent post with more information
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossenbux.com
 */

add_action( 'widgets_init', 'hb_recentpost_widgets' );

function hb_recentpost_widgets() {
	register_widget( 'HB_Recentpost_Widget' );
}

class hb_recentpost_widget extends WP_Widget {
	
	function HB_recentpost_Widget() {
	
		$widget_ops = array( 'classname' => 'hb_recentpost_widget', 'description' => 'A tabbed widget that display popular posts, recent posts, comments and tags.' );

		$control_ops = array( 'id_base' => 'hb_recentpost_widget' );

		$this->WP_Widget( 'hb_recentpost_widget', 'Humble - Latest Post', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );	

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		$tab = array();
		
		?>
        
        <div class="recentpost">
                   
           <ul>
    			<?php
				$recentPosts = new WP_Query();
				$recentPosts->query('ignore_sticky_posts=1&posts_per_page=3');
				while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
               
                <li>
                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <span class="date"><?php the_time(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></span>
                </li>
                
                <?php endwhile;?>
				
                <?php wp_reset_query(); ?>
                
            </ul>                
            
        </div>
        
		<?php

		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title' => 'From the blog'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
	
	<?php
	}
}
?>