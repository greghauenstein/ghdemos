<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
	<?php
		return;
	}
?>

<div class="grid_8">
	
    <div id="comments">
<?php if ( have_comments() ) : // if there are comments ?>
        
        <h3><?php comments_number('No Comment', '1 Comment', '% Comments'); ?> on "<?php the_title(); ?>"</h3>
        
        <ol>
            <?php wp_list_comments('type=comment&avatar_size=61&callback=hb_comment'); ?>
        </ol>
        
        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 class="pingheader"><?php _e('Trackbacks for this post', 'framework') ?></h3>
		
		<ol class="pinglist">
        	<?php wp_list_comments('type=pings'); ?>
        </ol>

        <?php endif; ?>

        <?php if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		<p class="nocomments">Comments are now closed for this article.</p>
		<?php endif; ?>
        
		<div class="clear"></div>
        
<?php else :  ?>

        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments">Comments are closed.</p><?php } ?>

        <?php endif; ?>

<?php endif; //  if no comments ?>

	<?php if ( comments_open() ) : ?>
    
    <div id="respond">
    
        <h3><?php comment_form_title( 'Leave a comment', 'Leave a comment to %s' ); ?></h3>
        
        <div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
        
        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf('You must be %1$slogged in%2$s to post a comment.', '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
        
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
        
        	<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf('Logged in as %1$s. %2$sLog out &raquo;%3$s', '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="Log out of this account">', '</a>') ?></p>
		
			<?php else : ?>
            
            <p>
            <input type="text" name="author" value="<?php echo esc_attr($comment_author); ?>" />
            <label>Name <small><?php if ($req) echo '*'; ?></small></label>
            </p>
            <p>
            <input type="text" name="email" value="<?php echo esc_attr($comment_author_email); ?>" />
            <label>Email <small><?php if ($req) echo '*'; ?></small></label>
            </p>
            <p>
            <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" />
            <label>Website</label>
            </p>
            
            <?php endif; ?>
            
            <p>
    	        <textarea name="comment"  cols="73" rows="10"></textarea>
	            <input type="submit" name="submit" class="btn" value="Submit my comment" />
                <?php comment_id_fields(); ?>
				<?php do_action('comment_form', $post->ID); ?>
            </p>
            
            <!-- <p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p> -->
            
            
        </form>
        
        <?php endif; // If registration required and not logged in ?>
        
        <div class="clear"></div>
    
    </div><!--respond-->

    <?php endif; // if you delete this the sky will fall on your head ?>
    
    </div><!--comments-->
    

    
</div><!--grid_8 alpha omega-->

