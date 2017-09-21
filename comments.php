<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.0.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()):
	return;
endif;
?>
<!-- Comment Area -->
<div class="comments-area space-top-3x" id="comments">
	<?php 
	if (have_comments()): 
		$comments_number = get_comments_number();
	?>
	<h3 class="comments-title">
      	<?php
      	esc_html_e('Comments', 'restarter');
      	if ($comments_number > 0): 
      	?>
      	<span class="comments-count"><?php echo absint($comments_number); ?></span>
  		<?php endif; ?>
    </h3><!-- .comments-title -->
    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<nav class="comment-navigation" id="comment-nav-above">
			<h1 class="sr-only"><?php esc_attr_e('Comment navigation', 'restarter'); ?></h1>
			<?php if (get_previous_comments_link()): ?>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments',
				'restarter')); ?></div>
			<?php endif;
				if (get_next_comments_link()): ?>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;',
				'restarter')); ?></div>
			<?php endif; ?>
		</nav><!-- #comment-nav-above -->
	<?php endif; ?>
	<ol class="comment-list">
		<?php
		wp_list_comments( array(
			'style'      => 'ol',
			'short_ping' => true,
			'callback' => 'Restarter::comments_list'
		) );
		?>
	</ol><!-- .comment-list -->
	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
		<nav class="comment-navigation" id="comment-nav-above">
			<h1 class="sr-only"><?php esc_attr_e('Comment navigation', 'restarter'); ?></h1>
			<?php if (get_previous_comments_link()): ?>
				<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments',
				'restarter')); ?></div>
			<?php endif;
				if (get_next_comments_link()): ?>
				<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;',
				'restarter')); ?></div>
			<?php endif; ?>
		</nav><!-- #comment-nav-above -->
	<?php 
		endif;
	endif; 
	if (! comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
	<p class="no-comments"><?php esc_attr_e('Comments are closed.', 'restarter'); ?></p>
	<?php endif; ?>
	<!-- Comment Reply -->
    <div class="comment-respond container space-top space-bottom-2x">
    	<div class="tile">
	    <?php
		$commenter = wp_get_current_commenter();
		$args = apply_filters('restarter_comment_form_args', array(
			'fields' => apply_filters('restarter_comment_form_default_fields', array(
				// Name Field
				'author' => '<div class="row"><div class="col-sm-4"><div class="form-element"><label for="author" class="sr-only">' . esc_html__('Name', 'restarter') . '</label><i class="pe-7s-user"></i><input id="author" name="author" type="text" class="form-control" required="required" value="' . esc_attr($commenter['comment_author']) . '" placeholder="' . esc_attr__('Name', 'restarter') . '" /></div></div>',
				// Email Field
				'email' => '<div class="col-sm-4"><div class="form-element"><label for="email" class="sr-only">' . esc_html__('Email', 'restarter') . '</label><i class="pe-7s-mail"></i><input id="email" name="email" type="email" class="form-control" required="required" value="' . esc_attr($commenter['comment_author_email']) . '" placeholder="' . esc_attr__('Email', 'restarter') . '" /></div></div>',
				// Website Field
				'url' => '<div class="col-sm-4"><div class="form-element"><label for="url" class="sr-only">' . esc_html__('Website', 'restarter') . '</label><i class="pe-7s-global"></i><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="' . esc_attr__('Website', 'restarter') . '" /></div></div></div><!-- .row -->',
			)) ,
			// Comment Field
			'comment_field' => '<div class="form-element"><label for="comment" class="sr-only">' . esc_html__('Comment', 'restarter') . '</label><i class="pe-7s-comment"></i><textarea id="comment" name="comment" class="form-control" rows="3" required="required" placeholder="' . esc_attr__('Comment', 'restarter') . '"></textarea></div><!-- .form-control -->',
			'title_reply' => __('Leave a comment', 'restarter') ,
			'logged_in_as' => '',
			'comment_notes_before' => '',
			'title_reply_before' => '<h3 class="comment-form-title space-bottom">',
			'title_reply_after' => '</h3>',
			'id_form' => 'restarter-comment-form',
			'class_submit' => 'btn btn-ghost btn-primary',
			'label_submit' => __('Submit comment', 'restarter')
		));
		// Render comments form.
		comment_form($args); 
		?>
		</div><!-- .tile -->
	</div><!-- .comments-area -->
</div><!-- #comments -->