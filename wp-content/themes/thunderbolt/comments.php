<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<!-- You can start editing here. -->
<?php if ($comments) : ?>
<div id="comments">
	<h3><?php comments_number('No', '1', '%' );?> Comments</h3>
	<?php foreach ($comments as $comment) : ?>
	<?php if (get_comment_type() == "comment"){ ?>
		<div class="comment_credentials">
		<?php comment_author_link() ?>
		</div>	
		<div class="comment_text">
		<?php if ($comment->comment_approved == '0') : ?>
		<em>Your comment is awaiting moderation.</em>
		<?php endif; ?>
		<?php comment_text() ?>
		</div>
 </div>
		<div class="clear"></div>
	<?php /* Changes every other comment to a different class */
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'alt';
	?>
	<?php } ?>
	<?php endforeach; /* end for each comment */ ?>
	<a name="showpings"></a>
	<?php foreach ($comments as $comment) : ?>
	<?php if (get_comment_type() != "comment"){ ?>
		<a name="showpings"></a>
		<div class="comment_credentials">
		<?php the_time('F jS Y') ?><br />
		<?php edit_comment_link('Moderate','',''); ?>
		</div>
		<div class="comment_text">
		<p><?php comment_author_link() ?></p>
		</div>
		<div class="clear"></div>
	<?php /* Changes every other comment to a different class */
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'alt';
	?>
	<?php } ?>
	<?php endforeach; /* end for each comment */ ?>

 	<?php else : // this is displayed if there are no comments so far ?>

  	<?php if ('open' == $post->comment_status) : ?> 
<div id="single_comment_holder">
		<h3>No Comments Yet</h3>
	 <?php else : // comments are closed ?>
		<p class="nocomments">Comments are closed.</p>
		
	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3>Comment</h3>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out">Logout &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>Mail <?php if ($req) echo "(required)"; ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>

<p><textarea name="comment" id="comment" style="width:440px;" cols="28" rows="5" tabindex="4"><?php if (function_exists('quoter_comment_server')) { quoter_comment_server(); } ?></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Remark" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>
<!-- If removed, comments will no longer work --!>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>