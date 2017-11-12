<?php
/**
 * The header for our theme.
 * Displays all of the <head> section.
 * This is the template that displays all of the <head> section and everything up until <div class="page-wrapper">
 *
 * @link 		https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg" <?php Restarter::html_tag_schema(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="author" content="<?php echo esc_attr(RESTARTER_THEME_AUTHOR); ?>" />
		<!--Mobile Specific Meta Tag-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php
		/**
		 * Functions hooked into "restarter_before_header" action
		 *
		 * @hooked restarter_skip_links				- 0
		 * @since 1.0.0
		 */
		do_action('restarter_before_header');
		?>
		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<!-- Navbar -->
			<header class="navbar<?php echo esc_attr(apply_filters('restarter_header_extra_cls', '')); ?>" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
				<div class="container">
					<div class="inner">
						<?php
						/**
						 * Functions hooked into "restarter_header" action
						 *
						 * @hooked restarter_site_brand              - 10
						 * @hooked restarter_primary_navigation      - 20
						 * @hooked restarter_header_toolbar          - 30
						 * @since 1.0.0
						 */
						do_action('restarter_header');
						?>
					</div><!-- .inner -->
				</div><!-- .container -->
			</header><!-- .navbar -->
			<?php
			do_action('restarter_after_header');