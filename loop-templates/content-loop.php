<?php
/**
 * The loop template file.
 * Included on pages like index.php, archive.php and search.php to display a loop of posts.
 *
 * @see 			http://codex.wordpress.org/The_Loop
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
/**
 * Functions hooked into "restarter_before_loop" action
 *
 * @hooked restarter_header_image       	      - 10
 * @hooked restarter_loop_wrapper_start       	  - 30
 * @since 1.0.0
 */
do_action('restarter_before_loop');

// Start the Loop
while (have_posts()): the_post();

	/*
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	get_template_part('template-parts/post-format/content', get_post_format());

endwhile;

/**
 * Functions hooked into "restarter_after_loop" action
 *
 * @hooked restarter_loop_pagination       		  - 10
 * @hooked restarter_loop_wrapper_end       	  - 30
 * @since 1.0.0
 */
do_action('restarter_after_loop');