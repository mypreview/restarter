<?php
/**
 * Restarter template functions.
 *
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
// ======================================================================
// Hooked into "restarter_before_header"
// ======================================================================
/**
 * Site brand.
 *
 * @package Hooked into "restarter_before_header".
 * @since 1.0.0
 */
if (!function_exists('restarter_skip_links')):
	function restarter_skip_links()

	{
		get_template_part('template-parts/header/skip-links');
	}
endif;
// ======================================================================
// Hooked into "restarter_header"
// ======================================================================
/**
 * Site brand.
 *
 * @package Hooked into "restarter_header".
 * @since 1.0.0
 */
if (!function_exists('restarter_site_brand')):
	function restarter_site_brand()

	{
		get_template_part('template-parts/header/site-brand');
	}
endif;
/**
 * Navigation.
 *
 * @package Hooked into "restarter_header".
 * @since 1.0.0
 */
if (!function_exists('restarter_primary_navigation')):
	function restarter_primary_navigation()

	{
		get_template_part('template-parts/header/navigation');
	}
endif;
/**
 * Toolbar.
 *
 * @package Hooked into "restarter_header".
 * @since 1.0.0
 */
if (!function_exists('restarter_header_toolbar')):
	function restarter_header_toolbar()

	{
		get_template_part('template-parts/header/toolbar');
	}
endif;
// ======================================================================
// Hooked into "restarter_before_loop"
// ======================================================================
/**
 * Header image.
 *
 * @package Hooked into "restarter_before_loop".
 * @since 1.0.0
 */
if (!function_exists('restarter_header_image')):
	function restarter_header_image()

	{
		get_template_part('template-parts/loop/header-image');
	}
endif;
/**
 * HTML wrapper start tag(s).
 *
 * @package Hooked into "restarter_before_loop".
 * @since 1.0.0
 */
if (!function_exists('restarter_loop_wrapper_start')):
	function restarter_loop_wrapper_start()

	{
		get_template_part('template-parts/loop/wrapper-start');
	}
endif;
// ======================================================================
// Hooked into "restarter_after_loop"
// ======================================================================
/**
 * Pagination.
 *
 * @package Hooked into "restarter_after_loop".
 * @since 1.0.0
 */
if (!function_exists('restarter_loop_pagination')):
	function restarter_loop_pagination($name = null)

	{
		get_template_part('template-parts/loop/pagination');
	}
endif;
/**
 * HTML wrapper end tag(s).
 *
 * @package Hooked into "restarter_after_loop".
 * @since 1.0.0
 */
if (!function_exists('restarter_loop_wrapper_end')):
	function restarter_loop_wrapper_end()

	{
		get_template_part('template-parts/loop/wrapper-end');
	}
endif;
// ======================================================================
// Hooked into "restarter_before_post"
// ======================================================================
/**
 * Header image.
 *
 * @package Hooked into "restarter_before_post".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_header')):
	function restarter_post_header()

	{
		get_template_part('template-parts/loop/header-image');
	}
endif;
/**
 * HTML wrapper start tag(s).
 *
 * @package Hooked into "restarter_before_post".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_wrapper_start')):
	function restarter_post_wrapper_start()

	{
		get_template_part('template-parts/loop/wrapper-start');
	}
endif;
// ======================================================================
// Hooked into "restarter_after_post_content"
// ======================================================================
/**
 * Paging.
 *
 * @package Hooked into "restarter_after_post_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_link_pages')):
	function restarter_post_link_pages()

	{
		get_template_part('template-parts/loop/paging');
	}
endif;
/**
 * Meta.
 *
 * @package Hooked into "restarter_after_post_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_meta')):
	function restarter_post_meta()

	{
		get_template_part('template-parts/post/meta');
	}
endif;
/**
 * Biography.
 *
 * @package Hooked into "restarter_after_post_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_biography')):
	function restarter_post_biography()

	{
		get_template_part('template-parts/post/biography');
	}
endif;
/**
 * Comments.
 *
 * @package Hooked into "restarter_after_post_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_comments')):
	function restarter_post_comments()

	{
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()):
			comments_template();
		endif;
	}
endif;
// ======================================================================
// Hooked into "restarter_after_post"
// ======================================================================
/**
 * HTML wrapper end tag(s).
 *
 * @package Hooked into "restarter_after_post".
 * @since 1.0.0
 */
if (!function_exists('restarter_post_wrapper_end')):
	function restarter_post_wrapper_end()

	{
		get_template_part('template-parts/loop/wrapper-end');
	}
endif;
// ======================================================================
// Hooked into "restarter_before_page"
// ======================================================================
/**
 * Header image.
 *
 * @package Hooked into "restarter_before_page".
 * @since 1.0.0
 */
if (!function_exists('restarter_page_header')):
	function restarter_page_header()

	{
		get_template_part('template-parts/loop/header-image');
	}
endif;
/**
 * HTML wrapper start tag(s).
 *
 * @package Hooked into "restarter_before_page".
 * @since 1.0.0
 */
if (!function_exists('restarter_page_wrapper_start')):
	function restarter_page_wrapper_start()

	{
		get_template_part('template-parts/loop/wrapper-start');
	}
endif;
// ======================================================================
// Hooked into "restarter_after_page_content"
// ======================================================================
/**
 * Paging.
 *
 * @package Hooked into "restarter_after_page_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_page_link_pages')):
	function restarter_page_link_pages()

	{
		get_template_part('template-parts/loop/paging');
	}
endif;
/**
 * Comments.
 *
 * @package Hooked into "restarter_after_page_content".
 * @since 1.0.0
 */
if (!function_exists('restarter_page_comments')):
	function restarter_page_comments()

	{
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()):
			comments_template();
		endif;
	}
endif;
// ======================================================================
// Hooked into "restarter_after_page"
// ======================================================================
/**
 * HTML wrapper end tag(s).
 *
 * @package Hooked into "restarter_after_page".
 * @since 1.0.0
 */
if (!function_exists('restarter_page_wrapper_end')):
	function restarter_page_wrapper_end()

	{
		get_template_part('template-parts/loop/wrapper-end');
	}
endif;
// ======================================================================
// Hooked into "restarter_before_footer"
// ======================================================================
/**
 * Scroll to top button.
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_scroll_to_top')):
	function restarter_footer_scroll_to_top()

	{
		get_template_part('template-parts/footer/scroll-to-top');
	}
endif;
// ======================================================================
// Hooked into "restarter_footer"
// ======================================================================
/**
 * HTML wrapper start tag(s).
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_wrapper_start')):
	function restarter_footer_wrapper_start()

	{
		get_template_part('template-parts/footer/wrapper-start');
	}
endif;
/**
 * Credits.
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_credits')):
	function restarter_footer_credits()

	{
		get_template_part('template-parts/footer/credits');
	}
endif;
/**
 * Navigation.
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_navigation')):
	function restarter_footer_navigation()

	{
		get_template_part('template-parts/footer/navigation');
	}
endif;
/**
 * Social links.
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_social_links')):
	function restarter_footer_social_links()

	{
		get_template_part('template-parts/footer/social-links');
	}
endif;
/**
 * HTML wrapper end tag(s).
 *
 * @package Hooked into "restarter_footer".
 * @since 1.0.0
 */
if (!function_exists('restarter_footer_wrapper_end')):
	function restarter_footer_wrapper_end()

	{
		get_template_part('template-parts/footer/wrapper-end');
	}
endif;