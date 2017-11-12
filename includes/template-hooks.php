<?php
/**
 * Restarter hooks.
 *
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.0
 */
/**
 * Header
 *
 * @see  restarter_skip_links()					-> template-functions.php
 * @see  restarter_site_brand()					-> template-functions.php
 * @see  restarter_primary_navigation()			-> template-functions.php
 * @see  restarter_header_toolbar()				-> template-functions.php
 * @since 1.0.0
 */
add_action('restarter_before_header', 'restarter_skip_links', 0);
add_action('restarter_header', 'restarter_site_brand', 10);
add_action('restarter_header', 'restarter_primary_navigation', 20);
add_action('restarter_header', 'restarter_header_toolbar', 30);
/**
 * Homepage
 *
 * @see  restarter_jumbotron()					-> template-functions.php
 * @see  restarter_homepage_content()			-> template-functions.php
 * @since 1.1.0
 */
add_action('restarter_before_homepage', 'restarter_jumbotron', 10);
add_action('restarter_homepage', 'restarter_homepage_content', 80);
/**
 * Loop
 *
 * @see  restarter_header_image()				-> template-functions.php
 * @see  restarter_loop_wrapper_start()			-> template-functions.php
 * @see  restarter_loop_pagination()			-> template-functions.php
 * @see  restarter_loop_wrapper_end()			-> template-functions.php
 * @since 1.0.0
 */
add_action('restarter_before_loop', 'restarter_header_image', 10);
add_action('restarter_before_loop', 'restarter_loop_wrapper_start', 30);
add_action('restarter_after_loop', 'restarter_loop_pagination', 10);
add_action('restarter_after_loop', 'restarter_loop_wrapper_end', 30);
/**
 * Post
 *
 * @see  restarter_post_header()				-> template-functions.php
 * @see  restarter_post_wrapper_start()			-> template-functions.php
 * @see  restarter_post_link_pages()			-> template-functions.php
 * @see  restarter_post_meta()					-> template-functions.php
 * @see  restarter_post_biography()				-> template-functions.php
 * @see  restarter_post_comments()				-> template-functions.php
 * @see  restarter_post_wrapper_end()			-> template-functions.php
 * @since 1.0.0
 */
add_action('restarter_before_post', 'restarter_post_header', 10);
add_action('restarter_before_post', 'restarter_post_wrapper_start', 30);
add_action('restarter_after_post_content', 'restarter_post_link_pages', 10);
add_action('restarter_after_post_content', 'restarter_post_meta', 20);
add_action('restarter_after_post_content', 'restarter_post_biography', 30);
add_action('restarter_after_post_content', 'restarter_post_comments', 40);
add_action('restarter_after_post', 'restarter_post_wrapper_end', 20);
/**
 * Page
 *
 * @see  restarter_page_header()				-> template-functions.php
 * @see  restarter_page_wrapper_start()			-> template-functions.php
 * @see  restarter_page_link_pages()			-> template-functions.php
 * @see  restarter_page_comments()				-> template-functions.php
 * @see  restarter_page_wrapper_end()			-> template-functions.php
 * @since 1.0.0
 */
add_action('restarter_before_page', 'restarter_page_header', 10);
add_action('restarter_before_page', 'restarter_page_wrapper_start', 30);
add_action('restarter_after_page_content', 'restarter_page_link_pages', 10);
add_action('restarter_after_page_content', 'restarter_page_comments', 40);
add_action('restarter_after_page', 'restarter_page_wrapper_end', 20);
/**
 * Footer
 *
 * @see  restarter_footer_scroll_to_top()		-> template-functions.php
 * @see  restarter_footer_wrapper_start()		-> template-functions.php
 * @see  restarter_footer_credits()				-> template-functions.php
 * @see  restarter_footer_navigation()			-> template-functions.php
 * @see  restarter_footer_social_links()		-> template-functions.php
 * @see  restarter_footer_wrapper_end()			-> template-functions.php
 * @since 1.0.0
 */
add_action('restarter_before_footer', 'restarter_footer_scroll_to_top', 10);
add_action('restarter_footer', 'restarter_footer_wrapper_start', 5);
add_action('restarter_footer', 'restarter_footer_credits', 10);
add_action('restarter_footer', 'restarter_footer_navigation', 20);
add_action('restarter_footer', 'restarter_footer_social_links', 30);
add_action('restarter_footer', 'restarter_footer_wrapper_end', 35);