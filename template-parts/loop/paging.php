<?php
/**
 * Split WordPress posts and pages into multiple pages.
 *
 * @package 		Hooked into "restarter_after_post_content"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */

if (Restarter::is_paginated()):
?>
<!-- Pagination -->
<nav class="pagination paging">
	<div class="nav-links">
		<?php
		$args = apply_filters('restarter_paging_args', array(
			'before' => __('Pages:', 'restarter') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			'after' => '',
			'next_or_number' => 'number',
			'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			'nextpagelink' => __('Next', 'restarter') ,
			'previouspagelink' => __('Prev', 'restarter') ,
			'pagelink' => '%'
		));
		wp_link_pages($args);
		?>
	</div><!-- .nav-links -->
</nav><!-- .pagination -->
<?php endif;