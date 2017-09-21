<?php
/**
 * The template used for displaying page content in page.php and fluid width template.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
/**
 * Functions hooked into "restarter_before_page" action
 *
 * @hooked restarter_page_header       	      - 10
 * @hooked restarter_page_wrapper_start       - 30
 * @since 1.0.0
 */
do_action('restarter_before_page');

// Start the Loop
while (have_posts()): the_post();

	do_action('restarter_before_page_content');

	the_content();

	/**
	 * Functions hooked into "restarter_after_page_content" action
	 *
	 * @hooked restarter_page_link_pages   		- 10
	 * @hooked restarter_page_comments   		- 20
	 * @since 1.0.0
	 */
	do_action('restarter_after_page_content');

endwhile;

/**
 * Functions hooked into "restarter_after_page" action
 *
 * @hooked restarter_page_wrapper_end       	  - 20
 * @since 1.0.0
 */
do_action('restarter_after_page');