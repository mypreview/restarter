<?php
/**
 * Displaying a message that posts cannot be found.
 *
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.1
 */
?>
<div class="content-none">
	<?php if (is_home() && current_user_can('publish_posts')): ?>
	<h2><?php printf(esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'restarter') , esc_url(admin_url('post-new.php'))); ?></h2>
	<?php elseif (is_search()): ?>
	<h2 class="space-bottom-2x"><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'restarter'); ?></h2>
	<?php 
	get_search_form();
	else : 
	?>
	<h2 class="space-bottom-2x"><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'restarter'); ?></h2>
	<?php 
	get_search_form();
	endif;
	?>
</div><!-- .content-none -->