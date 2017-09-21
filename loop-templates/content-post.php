<?php
/**
 * The template used for displaying single post content in single.php
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
/**
 * Functions hooked into "restarter_before_post" action
 *
 * @hooked restarter_post_header       	      - 10
 * @hooked restarter_post_wrapper_start       - 30
 * @since 1.0.0
 */
do_action('restarter_before_post');

// Start the Loop
while (have_posts()): the_post();

	do_action('restarter_before_post_content');

	the_content();

	/**
	 * Functions hooked into "restarter_after_post_content" action
	 *
	 * @hooked restarter_post_link_pages   		- 10
	 * @hooked restarter_post_meta       		- 20
	 * @hooked restarter_post_biography   		- 30
	 * @hooked restarter_post_comments   		- 40
	 * @since 1.0.0
	 */
	do_action('restarter_after_post_content');

endwhile;

/**
 * Functions hooked into "restarter_after_post" action
 *
 * @hooked restarter_post_wrapper_end       	  - 20
 * @since 1.0.0
 */
do_action('restarter_after_post');