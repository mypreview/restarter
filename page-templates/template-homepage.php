<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `restarter_homepage` action.
 * By default this includes a variety of product displays and the page content itself.
 *
 * Template name:		Homepage
 * @see 				http://codex.wordpress.org/Template_Hierarchy
 * @author  			Mahdi Yazdani
 * @package 			Restarter
 * @since 				1.1.0
 */

get_header();

/**
 * Functions hooked into "restarter_before_homepage" action
 *
 * @hooked restarter_jumbotron      			- 10
 *
 * @since 1.1.0
 */
do_action('restarter_before_homepage');

/**
 * Functions hooked into "restarter_homepage" action
 *
 * @hooked restarter_homepage_content           - 80
 *
 * @since 1.1.0
 */
do_action('restarter_homepage');

get_footer();