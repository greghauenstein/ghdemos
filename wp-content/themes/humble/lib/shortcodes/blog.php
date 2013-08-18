<?php
function theme_shortcode_blog($atts, $content = null, $code) {
	global $wp_filter;
	$backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'number' => 3,
		'category' => '',
		'posts' => '',
		'excerpt' => 'true',
		'fullcontent' => 'false',
		'meta' => 'true',
		'readmore' => 'false'
	), $atts));
	
	$query = array(
		'posts_per_page' => (int)$number,
		'post_type'=>'post',
	);
	
	if ($category){
		$query['cat'] = $category;
	}
	
	if ($posts){
		$query['post__in'] = explode(',',$posts);
		$query['posts_per_page'] = '-1';
	}
	
	$tmp = new WP_Query($query);
	
	$output = '';
	
	if ($tmp->have_posts()) :
			while ($tmp->have_posts()) : $tmp->the_post();
					$commentscount = get_comments_number();
					if($commentscount == 0): $commenttext = 'No Comment'; endif;
					if($commentscount == 1): $commenttext = $commentscount . ' Comment'; endif;
					if($commentscount > 1): $commenttext = $commentscount . ' Comments'; endif;
					$output .= '
					<div class="entry shortcode" id="post-'.get_the_ID().'">
						<h3 class="title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
						<div class="meta">';
					if ($meta == 'true') {
						$output .= '<span class="date">Posted on '.get_the_time(get_option('date_format')).' @ '.get_the_time('g:ia').'</span> by <span class="author">'.get_the_author().'</span>';
					}		
					$output .= '<span class="comment">'.$commenttext.'</span>
						</div>';
						
					if (has_post_thumbnail()) {
						$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
						$thumb_object = get_post($post_thumbnail_id);
						$thumb = $thumb_object->guid;

						$output .= '
						<div class="thumbnail">
								<a href="'.get_permalink().'" title="'.get_the_title().'"><img src="'. get_bloginfo('template_directory').'/timthumb.php?src='.$thumb.'&h=100&w=600&zc=1&q=100" alt="'.get_the_title().'" /></a>
							</div>';
					}
					$output .= '<div class="excerpt">';
					if ($fullcontent == 'false') {
						if ($excerpt == 'true') {
							$output .= '<p>'.get_the_excerpt().'</p>';
						}
					} else {
						$output .= '<p>'.get_the_content().'</p>';
					}
					if ($readmore == 'true') {
						$output .= '<div class="more">
								<a class="button white" href="'.get_permalink().'" title="'.get_the_title().'">&raquo; Read more</a>
							</div>';
					}
					$output .= '</div>
					</div>';
				endwhile;
			endif;
	$wp_filter['the_content'] = $backup;
	wp_reset_query();
	return $output;
}

add_shortcode('blog','theme_shortcode_blog');