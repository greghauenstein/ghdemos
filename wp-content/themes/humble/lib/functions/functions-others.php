<?php

/*-----------------------------------------------*/
/* Post Thumbnail
/*-----------------------------------------------*/
add_theme_support('post-thumbnails');

/*-----------------------------------------------*/
/* Excerpt
/*-----------------------------------------------*/
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*-----------------------------------------------*/
/* Add browser detection class to body tag
/*-----------------------------------------------*/
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}


/*-----------------------------------------------*/
/* Remove inline CSS for recentcomment
/*-----------------------------------------------*/
function remove_recent_comments_style() {  
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
add_action( 'widgets_init', 'remove_recent_comments_style' ); 


/*-----------------------------------------------*/
/* Breadcrumb
/*-----------------------------------------------*/
function hb_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
  
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && !is_search() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __(' (page', 'humble') . ' ' . get_query_var('paged') . ')';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    } 
  }
}

/*-----------------------------------------------*/
/* Pagination
/*-----------------------------------------------*/
function hb_pagination( $pages = '', $range = 2 )
{  
	$showitems = ($range * 2) + 1;  
	global $paged;	
	if( empty( $paged ) ) $paged = 1;
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if( !$pages ) $pages = 1;
	}   
	if( 1 != $pages )
	{
		echo "<div id='pagination'>";
		if( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<a class=\"first\" href='" . get_pagenum_link(1) . "'>&laquo;</a>";
		if( $paged > 1 && $showitems < $pages ) echo "<a class=\"prev\" href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";
		for ( $i=1; $i <= $pages; $i++ )
		{
			if ( 1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) )
			{
			 echo ( $paged == $i ) ? "<a class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
			}
		}
		if ( $paged < $pages && $showitems < $pages ) echo "<a class=\"next\" href='" . get_pagenum_link($paged + 1) . "'>&rsaquo;</a>";  
		if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo "<a class=\"last\" href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo '<div class="clear"></div>';
		echo "</div>\n";
	}
}

/*-----------------------------------------------*/
/* Comments
/*-----------------------------------------------*/

// Custom Comments Display
function hb_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>   
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    	<div id="comment-<?php comment_ID(); ?>">
    	<div class="line"></div>
        <div class="image"><?php echo get_avatar($comment,$size='61'); ?></div>
        <div class="details">    
            <div class="name"><span class="author"><?php comment_author_link(); ?></span> <span class="date">&middot; <?php printf(__('%1$s at %2$s', 'humble'), get_comment_date(get_option('date_format')),  get_comment_time(get_option('time_format'))) ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span></div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.', 'humble') ?></em>
            <br />
            <?php endif; ?>
            <?php comment_text() ?>
        </div><!--details-->
        </div><!--comment-<?php comment_ID(); ?>-->
<?php
}


/*-----------------------------------------------*/
/* DISABLE ADMIN BAR
/*-----------------------------------------------*/
add_filter( 'show_admin_bar', '__return_false' );


/*-----------------------------------------------*/
/* Error message
/*-----------------------------------------------*/

function attention(){
	$errors = array();
	if(!function_exists("imagecreatetruecolor")){
		$errors[]='GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
	}
	if(!is_writeable(TEMPLATEPATH . '/cache/')){
		$errors[]='The cache folder ('.TEMPLATEPATH.'/cache/) is not writeable.';
	}
	if(!is_writeable(TEMPLATEPATH . '/cache/custom.css')){
		$errors[]='The skin style file ('.TEMPLATEPATH.'/cache/skin.css) is not writeable.';
	}
	
	$str = '';
	if(!empty($errors)){
		$str = '<ul>';
		foreach($errors as $error){
			$str .= '<li>'.$error.'</li>';
		}
		$str .= '</ul>';
		echo "
			<div id='theme-warning' class='error fade'><p><strong>".sprintf(__('%1$s error messages', 'humble'), 'Humble Template')."</strong><br/>".$str."</p></div>
		";
	}	
}

add_action('admin_notices', 'attention');

/*-----------------------------------------------*/
/* LANGUAGES
/*-----------------------------------------------*/

load_theme_textdomain( 'humble', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if (is_readable($locale_file)) require_once($locale_file);

