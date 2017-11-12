<?php
/**
 * Restarter functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * Do not add any custom code here.
 * Please use a custom plugin or child theme so that your customizations aren't lost during updates.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 *
 * @see 		https://codex.wordpress.org/Theme_Development
 * @see 		https://codex.wordpress.org/Plugin_API
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 		1.0.0
 */
// Assign the "Restarter" info to constants.
$restarter_theme = wp_get_theme('restarter');
define('RESTARTER_THEME_NAME', $restarter_theme->get('Name'));
define('RESTARTER_THEME_URI', $restarter_theme->get('ThemeURI'));
define('RESTARTER_THEME_AUTHOR', $restarter_theme->get('Author'));
define('RESTARTER_THEME_AUTHOR_URI', $restarter_theme->get('AuthorURI'));
define('RESTARTER_THEME_VERSION', $restarter_theme->get('Version'));
// Restarter only works in WordPress 4.7 or later.
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')):
	require get_template_directory() . '/includes/back-compat.php';

endif;
/**
 * Initialize all the things.
 *
 * @since 1.0.0
 */
$restarter = (object)array(
	'version' 			=> 		RESTARTER_THEME_VERSION,
	'main' 				=> 		require 'includes/class-restarter.php',
	'customizer' 		=> 		require 'includes/class-restarter-customizer.php',
	'bs_navwalker' 		=> 		require 'includes/class-restarter-bootstrap-navwalker.php',
	'recent_comments' 	=> 		require 'includes/class-restarter-recent-comments-widget.php'
);
require 'includes/template-hooks.php';
require 'includes/template-functions.php';