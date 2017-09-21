<?php
/**
 * Extend WordPress core recent comments widget.
 * Inspired by WordPress core recent comments widget "class-wp-widget-recent-comments.php"
 *
 * @see 		https://github.com/WordPress/WordPress/blob/master/wp-includes/widgets/class-wp-widget-recent-comments.php#L69-L124
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.0.0
 */

/**
 * The setup Restarter_Recent_Comments_Widget class
 */
class Restarter_Recent_Comments_Widget extends WP_Widget_Recent_Comments

{
	/**
     * Outputs the content of the widget.
     *
     * @since 1.0.0
     */
	public function widget($args, $instance)

	{
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments', 'restarter') : $instance['title'], $instance, $this->id_base);
		$number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		$comments = get_comments(apply_filters('widget_comments_args', array(
			'number' => $number,
			'status' => 'approve',
			'post_status' => 'publish'
		)));
		// Before widget code, if any
		echo $args['before_widget'];
		// The title and the text output
		if ($title):
			echo $args['before_title'] . $title . $args['after_title'];
		endif;
		if (is_array($comments) && $comments):
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique(wp_list_pluck($comments, 'comment_post_ID'));
			_prime_post_caches($post_ids, strpos(get_option('permalink_structure') , '%category%') , false);
		?>
		<ul>
			<?php foreach((array) $comments as $comment): ?>
			<li class="recentcomments">
				<a href="<?php comment_link($comment); ?>" target="_self"><?php echo esc_html(get_the_title($comment->comment_post_ID)); ?></a>
					<span class="comment-meta">
					<span>
					<?php
					esc_html_e('by ', 'restarter');
					comment_author($comment);
					?>
					</span>
					<span><?php comment_date(apply_filters('restarter_recent_comments_date_format', 'n/j/y'), $comment); ?></span>
				</span>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php
		endif;
		// After widget code, if any
		echo $args['after_widget'];
		wp_reset_postdata();
	}
}
/**
 * Register the Widget.
 *
 * @package Hooked into "widgets_init"
 * @since 1.0.0
 */
if (!function_exists('restarter_recent_comments_widget')):
	function restarter_recent_comments_widget()
	{
		unregister_widget('WP_Widget_Recent_Comments');
		register_widget('Restarter_Recent_Comments_Widget');
	}
endif;
add_action('widgets_init', 'restarter_recent_comments_widget', 10);