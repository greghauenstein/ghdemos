<?php
/*
 * Plugin Name: Custom Latest Post
 * Plugin URI: http://www.karimhossenbux.com
 * Description: A widget recent post with more information
 * Version: 1.0
 * Author: Karim Hossenbux
 * Author URI: http://www.karimhossenbux.com
 */

add_action( 'widgets_init', 'hb_widget_recentposts' );

function hb_widget_recentposts() {
	register_widget( 'hb_widget_recentposts' );
}

class hb_widget_recentposts extends WP_Widget {

	function hb_widget_recentposts() {
		$widget_ops = array('classname' => 'hb_recentpost_widget', 'description' => "Displays the recent posts on your site" );
		$this->WP_Widget('recent_posts', 'Humble - Recent posts', $widget_ops);
		$this->alt_option_name = 'widget_recent_posts';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('theme_widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
		if ( !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 80;
		else if ( $desc_length < 1 )
			$desc_length = 1;
		
		$disable_thumbnail = $instance['disable_thumbnail'] ? '1' : '0';
		$disable_description = $instance['disable_description'] ? '1' : '0';
		
		$query = array('showposts' => $number, 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
		if(!empty($instance['cat'])){
			$query['cat'] = implode(',', $instance['cat']);
		}

		$r = new WP_Query($query);
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div class="recentpost">
			<ul>
			
			<?php while ($r->have_posts()) : $r->the_post(); ?>
				<li>
					<?php if(!$disable_thumbnail): ?>
						<a class="thumb_widget" href="<?php echo get_permalink() ?>" title="<?php the_title();?>">
						<?php if (has_post_thumbnail() ): ?>
							<?php the_post_thumbnail(array(50,50),array('title'=>get_the_title(),'alt'=>get_the_title())); ?>	
						<?php endif; ?>
						</a>
					<?php endif; ?>
						
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	                <span class="date"><?php the_time(get_option('date_format')); ?> at <?php the_time(get_option('time_format')); ?></span>
					<?php if(!$disable_description): ?>
						<p class="desc"><?php echo wp_html_excerpt(get_the_excerpt(),$desc_length);?>...</p>
					<?php endif; ?>
						
					<div class="clear"></div>
				</li>
			<?php endwhile; ?>
			
			</ul>
			<?php echo $after_widget; ?>
		</div>
		
		<?php
		wp_reset_query();
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('theme_widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['desc_length'] = (int) $new_instance['desc_length'];
		$instance['disable_thumbnail'] = !empty($new_instance['disable_thumbnail']) ? 1 : 0;
		$instance['disable_description'] = !empty($new_instance['disable_description']) ? 1 : 0;
		$instance['cat'] = $new_instance['cat'];

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['theme_widget_recent_posts']) )
			delete_option('theme_widget_recent_posts');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('theme_widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$disable_thumbnail = isset( $instance['disable_thumbnail'] ) ? (bool) $instance['disable_thumbnail'] : false;
		$disable_description = isset( $instance['disable_description'] ) ? (bool) $instance['disable_description'] : false;
		$display_extra_type = isset( $instance['display_extra_type'] ) ? $instance['display_extra_type'] : 'time';
		$cat = isset($instance['cat']) ? $instance['cat'] : array();

		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;

		if ( !isset($instance['desc_length']) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 60;

		$categories = get_categories('orderby=name&hide_empty=0');
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>">Number of posts to show</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_thumbnail'); ?>" name="<?php echo $this->get_field_name('disable_thumbnail'); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id('disable_thumbnail'); ?>">Don't show thumbnail</label></p>
		
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('disable_description'); ?>" name="<?php echo $this->get_field_name('disable_description'); ?>"<?php checked( $disable_description ); ?> />
		<label for="<?php echo $this->get_field_id('disable_description'); ?>">Don't show description</label></p>
		
		
		<p><label for="<?php echo $this->get_field_id('desc_length'); ?>">Description lenght:</label>
		<input id="<?php echo $this->get_field_id('desc_length'); ?>" name="<?php echo $this->get_field_name('desc_length'); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id('cat'); ?>">Categories</label>
			<select style="height:5.5em" name="<?php echo $this->get_field_name('cat'); ?>[]" id="<?php echo $this->get_field_id('cat'); ?>" class="widefat" multiple="multiple">
				<?php foreach($categories as $category):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array($category->term_id, $cat)? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php
	}
}