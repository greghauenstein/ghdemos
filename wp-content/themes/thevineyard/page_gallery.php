<?php
/*
Template Name: Gallery Page
*/
?>

<?php 

global $more, $wp_query, $wpdb;

get_header();

$pagetitle = get_the_title();
$pageid = $wp_query->post->ID;
$categories = get_post_meta($pageid, "categories", true);
$showimages = get_post_meta($pageid, "showimages", true);
$showtitle = get_post_meta($pageid, "showtitle", true);
$showdate = get_post_meta($pageid, "showdate", true);
$showtext = get_post_meta($pageid, "showtext", true);
$showreadmore = get_post_meta($pageid, "showreadmore", true);
$columncount = (get_post_meta($pageid, "columns", true)) ? get_post_meta($pageid, "columns", true) : 2;
$removesidebar = get_post_meta($pageid, "removesidebar", true);
$classes = get_sidebar_position_classes($removesidebar);




?>


<?php if($removesidebar != 'yes') :?>	
<div class='<?php echo $classes['sidebar'] ?> sidebar'>
	<?php  dynamic_sidebar( rf_get_sidebar($post->ID) ); ?>
</div>
<?php endif ?>

<div class='<?php echo $classes['content'] ?> post-list'>
		
		<div class='post' id="portfolio">


             <div class="post-content">
                            
                    <ul class="portfolio-filter">
                        <li>
                        	<a class="current readmore_button" rel="all" href="#">
                            	<span class="title">All</span>
                            </a>
                        </li>
                        
                        <?php $count = 0;
                        $cats = explode(',',$categories);
						
						foreach ($cats as $cat) { ?>
                            <li>
                            	<a class="readmore_button" rel="cat-<?php echo $cat; ?>" href="#">
                                	<span class="title"><?php echo get_cat_name($cat); ?></span>
                                </a>
                                
                            </li>
                            <?php $count++;
                        } ?>
                        
                    </ul>
                    
                    <ul class="portfolio-items" data-cols='<?php echo $columncount ?>'>
                    
                        <?php $count = 1; 
                                                
                        query_posts(array(
                        	"posts_per_page" => -1,
                        	"post_type" => array("post", "product"),
                        	"cat" => $categories,
                     	
                        ));
                        

                        while( have_posts() ) : the_post(); $more = 0;
							$column_class = array();                        
                        	$column_class[] = 'column'.$columncount.'x1'; 

                         	$clear = false;
                         	if($count%$columncount == 0) {
                         		$column_class[] = "last";
                         		$clear = true;
                         	}
                         	elseif(($count-1)%$columncount == 0) {
                         		$column_class[] = "first";
               
                         	}
      
                       	
                        	$column_class = implode(" ", $column_class);
         
                        	
                        	//$clear =  ( $count % ($columncount+1) ) ? "" : "style='clear:both'";
                            $post_categories = wp_get_post_categories( get_the_id() );
                            $cats = array();
                                             
                            
                           foreach($post_categories as $c){
                                $cat = get_category( $c );
                                array_push($cats, 'cat-'.$cat->term_id);
                            }  ?>
                               
                            <?php $class = ( !$showtitle AND !$showdate AND !$showtext AND !$showreadmore) ? "noborder" : ""  ?>
   
                            <li class="column <?php echo $column_class." ".$class ?> portfolio-item all <?php echo implode(' ',$cats); ?>" <?php echo $clear ?> >
                                
                                <?php if ($showimages) {
                                    if (has_post_thumbnail()) { ?>
                                        <div class="image-container">
                                            <?php if ($showreadmore) { ?><a class="hoverfade" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php }
                                                $sb = ($removesidebar == "yes") ? "nosb" : "sb";
                                               	$size = "gallery-".$sb."-".$columncount;
                                                $thumb_id = get_post_thumbnail_id();
                                                $thumb = wp_get_attachment_image_src($thumb_id, $size);
                                                echo "<img src='".$thumb[0]."'>";
                                               
                                            if ($showreadmore) { ?></a><?php } ?>
                                        </div>
                                    <?php }
                                }
                                
                               if( $showtitle OR $showdate OR $showtext OR $showreadmore) :
                               echo '<div class="portfolio_content">';
                            
                                if ($showtitle) { ?>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                                        <h4 <?php if($showimages) { echo 'class="image-container-spacing"'; } ?>>
                                            <?php the_title() ?>
                                        </h4>
                                    </a>
                                <?php }
                                
                                if ($showdate) { ?>
                                    <div class="portfolio-date">
                                        Posted on <?php the_time('F j, Y'); ?>
                                    </div>
                                <?php }
                                
                                if ($showtext) { ?>
                                    <div class="portfolio-content">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php }
                                
                                if ($showreadmore) { ?>
                                    <a class="read-more" href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">Read more</a>
                                <?php } ?>
                                
                                </div>
                                
                                <?php endif ?>
                                
                            </li>
                            
                         
                            <?php $count++;
                            
                        endwhile;
                        
                        wp_reset_query(); ?> 
                        
                    </ul>	

                </div>


		</div>


</div>

<div class="clear"></div>

	
		
<?php get_footer(); ?>
