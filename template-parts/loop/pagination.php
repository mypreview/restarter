<?php
/**
 * Displaying navigation to next/previous set of posts when applicable.
 *
 * @package 		Hooked into "restarter_after_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
global $wp_query;
$big = 999999999; // need an unlikely integer
$page_numbers = paginate_links(apply_filters('restarter_pagination_args', array(
	'base' => esc_url_raw(str_replace(999999999, '%#%', get_pagenum_link(999999999, false))) ,
	'format' => '?paged=%#%',
	'type' => 'array',
	'prev_next' => false,
	'current' => max(1, get_query_var('paged')) ,
	'total' => $wp_query->max_num_pages,
	'prev_text' => '',
	'next_text' => '',
	'before_page_number' => '',
	'after_page_number' => ''
)));
?>
<!-- Pagination -->
<nav class="pagination">
	<div class="nav-links">
		<?php 
		if (is_array($page_numbers)):
			$get_prev_post_link = get_previous_posts_link();
			if ( !empty($get_prev_post_link)):
				previous_posts_link(sprintf(__('%s Prev', 'restarter'), '<i class="icon-arrow-left"></i> '));
			else:
			?>
			<a class="prev page-numbers disabled" href="#">
            	<i class="icon-arrow-left"></i>
            	<?php esc_html_e('Prev', 'restarter'); ?>
          	</a>
			<?php
			endif;
			foreach($page_numbers as $page_number):
				echo wp_kses($page_number, array(
					'a' => array(
						'id' => array() ,
						'href' => array() ,
						'title' => array() ,
						'class' => array()
					) ,
					'span' => array(
						'id' => array() ,
						'class' => array()
					)
				));
			endforeach;
			$get_next_post_link = get_next_posts_link();
			if ( !empty($get_next_post_link)):
				next_posts_link(sprintf(__('Next %s', 'restarter'), ' <i class="icon-arrow-right"></i>'));
			else:
			?>
			<a class="next page-numbers disabled" href="#">
            	<?php esc_html_e('Next', 'restarter'); ?>
            	<i class="icon-arrow-right"></i>
          	</a>
			<?php
			endif;
		endif;
		?>
	</div><!-- .nav-links -->
</nav><!-- .pagination -->