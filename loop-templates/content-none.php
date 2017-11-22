<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @see 			http://codex.wordpress.org/Template_Hierarchy
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.3
 */
/**
 * Functions hooked into "restarter_before_post" action
 *
 * @hooked restarter_post_header       	      - 10
 * @hooked restarter_post_wrapper_start       - 30
 * @since 1.0.0
 */
do_action('restarter_before_post');

get_template_part('template-parts/none/content');

/**
 * Functions hooked into "restarter_after_post" action
 *
 * @hooked restarter_post_wrapper_end       	  - 20
 * @since 1.0.0
 */
do_action('restarter_after_post');
