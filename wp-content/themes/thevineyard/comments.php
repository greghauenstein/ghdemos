<div id="comments">

<?php if ( post_password_required() ) { ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'newbusiness' ); ?></p>
    </div><!-- #comments -->
	<?php return;
}

if ( have_comments() ) { ?>
    <h2>
    	<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'newbusiness' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
    </h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'newbusiness' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'newbusiness' ) ); ?></div>
        </div> <!-- .navigation -->
    <?php } ?>
    
    <ol class="commentlist">
        <?php wp_list_comments( array( 'callback' => 'newbusiness_comment' ) ); ?>
    </ol>
    
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
        <div class="navigation">
            <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'newbusiness' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'newbusiness' ) ); ?></div>
        </div><!-- .navigation -->
    <?php } else {
        if ( !comments_open() ) { ?>
        	<p class="nocomments"><?php _e( 'Comments are closed.', 'newbusiness' ); ?></p>
    	<?php }
	} ?>

<?php }
$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">Your Comment</textarea></p>';
$args['comment_notes_after'] = '';

$author_label =  __( 'Name' ) . ( $req ? '*' : '' );
$email_label =  __( 'Email' ) . ( $req ? '*' : '' );
$url_label = __( 'Website' );
$author_value = (empty($commenter['comment_author'] )) ? $author_label : esc_attr( $commenter['comment_author'] );
$email_value = (empty($commenter['comment_author_email'] )) ? $email_label : esc_attr( $commenter['comment_author_email'] );
$url_label = (empty($commenter['comment_author_url'] )) ? $url_label : esc_attr( $commenter['comment_author_url'] );

$fields =  array(
	'author' => '<p class="comment-form-author">
	            <input id="author" name="author" type="text" value="' . $author_value . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p class="comment-form-email">
	            <input id="email" name="email" type="text" value="' . $email_value . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p class="comment-form-url">
	            <input id="url" name="url" type="text" value="' . $url_label . '" size="30" /></p>',
); 
$args['fields'] = $fields;

comment_form($args); ?>


<?php function newbusiness_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-single post-content">
		<div class="comment-gravatar vcard">
			<?php echo get_avatar( $comment, 80, get_template_directory_uri()."/images/avatar.png" ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'newbusiness' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata">
        	<cite class="fn"><?php comment_author_link() ?></cite>
        	<!--<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">-->
				<?php printf( __( '%1$s at %2$s', 'newbusiness' ), get_comment_date(),  get_comment_time() ); ?>
            <!--</a>-->
			<?php edit_comment_link( __( 'edit', 'newbusiness' ), '- ' ); ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>
		<div class='clearfix'></div>
	</div><!-- #comment-##  -->

	<?php
		break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'newbusiness' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'newbusiness'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
} ?>

</div><!-- #comments -->