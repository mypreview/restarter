<?php
/**
 * Restarter back compat functionality
 * Inspired by Twenty Sixteen back-compat.php
 *
 * Prevents Restarter from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @see 		https://github.com/WordPress/twentysixteen
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.0.0
 */
/**
 * Prevent switching to Restarter on old versions of WordPress.
 * Switches to the default theme.
 *
 * @since 1.0.0
 */
if (!function_exists('restarter_switch_theme')):
	function restarter_switch_theme()
	{
		switch_theme(WP_DEFAULT_THEME, WP_DEFAULT_THEME);
		unset($_GET['activated']);
		add_action('admin_notices', 'restarter_upgrade_notice');
	}
endif;
add_action('after_switch_theme', 'restarter_switch_theme');
/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Restarter on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('restarter_upgrade_notice')):
	function restarter_upgrade_notice()
	{
		$message = sprintf(__('Restarter requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'restarter') , $GLOBALS['wp_version']);
		printf('<div class="error"><p>%s</p></div>', $message);
	}
endif;
/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('restarter_customize')):
	function restarter_customize()
	{
		wp_die(sprintf(__('Restarter requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'restarter') , $GLOBALS['wp_version']) , '', array(
			'back_link' => true,
		));
	}
endif;
add_action('load-customize.php', 'restarter_customize');
/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 *
 * @since 1.0.0
 */
if (!function_exists('restarter_preview')):
	function restarter_preview()
	{
		if (isset($_GET['preview'])):
			wp_die(sprintf(__('Restarter requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'restarter') , $GLOBALS['wp_version']));
		endif;
	}
endif;
add_action('template_redirect', 'restarter_preview');