<?php
function theme_shortcode_portfolio($atts, $content = null, $code) {
	global $wp_filter;
	$backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'number' => 1,
		'col' => 1,
		'category' => '',
		'posts' => '',
		'format' => 'fullwidth',
		'last' => 'false'
	), $atts));
	
	$query = array(
		'posts_per_page' => (int)$number,
		'post_type'=>'portfolio',
	);
	
	if ($category){
		$query['tax_query'] = array(
			array(
				'taxonomy' => 'portfolio_category',
				'field' => 'id',
				'terms' => $category
			)
		);
	}
	
	if ($posts){
		$query['post__in'] = explode(',',$posts);
		$query['posts_per_page'] = '-1';
	}
	
	$tmp = new WP_Query($query);
	
	if ($last == 'true') {
		$position = ' last';
	} else {
		$position = '';
	}
	
	if ($format == 'fullwidth') {
		$output = '<div class="portfolio shortcode">';
	} else {
		$output = '<div class="portfolio shortcode normal two_third'.$position.'">';
	}
	
	$i = 1;
	
	$cols = array('1' => 'two_third', '2' => 'one_half', '3' => 'one_third', '4' => 'one_fourth');
	$img_w = array('1' => '590', '2' => '430', '3' =>'270', '4' => '195');
	$img_h = array('1' => '240', '2' => '200', '3' =>'140', '4' => '100');
	$posts_per_page = array('1' => '4', '2' => '6', '3' =>'9', '4' => '12');

	$portfolio_cols = $col;
	
	if ($tmp->have_posts()) :
		while ($tmp->have_posts()) : $tmp->the_post();

			if (has_post_thumbnail()) {			
				$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
				$thumb_object = get_post($post_thumbnail_id);
				$thumb = $thumb_object->guid;
				$taxonomy = wp_get_object_terms(get_the_ID(), 'portfolio_category');	
			}

			if ($format == 'fullwidth') {
					
				if ($portfolio_cols == '1') :
					$output .= '
						<div class="one_third one_col">
							<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
							<div class="project_desc">';
								$desc = get_post_meta(get_the_ID(), '_hb_project_desc', true);
								$output .= $desc.'
							</div>
							<div class="meta">
								<span class="time">'.get_the_time('F Y').'</span><span class="category">'.$taxonomy[0]->name.'</span>
							</div>
						</div>';
				endif;
				
				$output .= '
						<div class="'.$cols[$portfolio_cols];
					if ($i%$portfolio_cols == 0) $output .= ' last';
					$output .= '">
							<div class="thumbnail" style="background-image: url('.get_bloginfo('template_directory').'/timthumb.php?src='.$thumb.'&h='.$img_h[$portfolio_cols].'&w='.$img_w[$portfolio_cols].'&zc=1&q=100);">
								<a class="overlay" href="'.get_permalink().'"></a>';
							if ($portfolio_cols != 1) :
								$output .= '
								<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
								<div class="meta">
									<span class="time">'.get_the_time('F Y').'</span><span class="category">'.$taxonomy[0]->name.'</span>
								</div>';
							endif;
							$output .= '
							</div>
						</div>
					';
					
			} else {
			
				$output .= '
					<div class="one_half';
					if ($i%$portfolio_cols == 0) $output .= ' last';
					$output .= '">
						<div class="thumbnail" style="background-image: url('.get_bloginfo('template_directory').'/timthumb.php?src='.$thumb.'&h=140&w=280&zc=1&q=100);">
							<a class="overlay" href="'.get_permalink().'"></a>';
						if ($portfolio_cols != 1) :
							$output .= '
							<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>
							<div class="meta">
								<span class="time">'.get_the_time('F Y').'</span><span class="category">'.$taxonomy[0]->name.'</span>
							</div>';
						endif;
						$output .= '
						</div>
					</div>
				';
		
			}
			
			
			$i++;
					
		endwhile;
	endif;
	
	$output .= '
		<div class="clear"></div>
	</div><div class="clear"></div>';
	
	$wp_filter['the_content'] = $backup;
	wp_reset_query();
	return $output;
}

add_shortcode('portfolio','theme_shortcode_portfolio');