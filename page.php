<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @see 		http://codex.wordpress.org/Template_Hierarchy
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 		1.0.0
 */

get_header();

if (have_posts()) :
	get_template_part('loop-templates/content', 'page');
else :
	get_template_part('loop-templates/content', 'none');
endif;

get_footer();