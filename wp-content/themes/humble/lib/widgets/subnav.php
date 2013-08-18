<?php
/*
 * Plugin Name: Sub Page Navigation
 * Plugin URI: http://www.karimhossenbux.com
 * Description: A widget that displays page sub menu
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossnebux.com
 */


add_action( 'widgets_init', 'hb_subnavs_widgets' );


function hb_subnavs_widgets() {
	register_widget( 'HB_Subnav_Widget' );
}

class HB_Subnav_Widget extends WP_Widget {
	
	function HB_Subnav_Widget() {
	
		$widget_ops = array( 'classname' => 'hb_subnav_widget', 'description' => __('A widget that displays  sub page navigation.', 'framework') );

		$this->WP_Widget( 'HB_Subnav_Widget', __('Humble - Sub Page Navigation','framework'), $widget_ops );
	}

	
	
	function widget( $args, $instance ) {
		global $post;
		$children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
		if ($children) {
			$parent = $post->ID;
		}else{
			$parent = $post->post_parent;
			if(!$parent){
				$parent = $post->ID;
			}
		}
		$parent_title = get_the_title($parent);
		
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? $parent_title : $instance['title'], $instance, $this->id_base);
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		if (empty($exclude)) $exclude = '';
		$output = wp_list_pages( array('title_li' => '', 'echo' => 0, 'child_of' =>$parent, 'sort_column' => $sortby, 'exclude' => $exclude, 'depth' => 1) );

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
		?>
		<ul>
			<?php echo $output; ?>
		</ul>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'menu_order', 'title' => '', 'exclude' => '') );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'framework'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:', 'framework'); ?></label>
			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>><?php _e('Page order', 'framework'); ?></option>
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>><?php _e('Page title', 'framework'); ?></option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Page ID', 'framework' ); ?></option>
			</select>
		</p>
<?php
	}
	
	
}
?>