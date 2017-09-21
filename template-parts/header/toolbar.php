<?php
/**
 * Display header toolbar.
 *
 * @package 		Hooked into "restarter_header"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<!-- Toolbar -->
<div class="toolbar">
	<?php if (apply_filters('restarter_header_search', true)): ?>
	<div class="search-btn">
		<i class="pe-7s-search"></i>
		<?php get_search_form(); ?>
	</div><!-- .search-btn -->
	<?php endif; ?>
	<span class="divider"></span>
	<?php if (apply_filters('restarter_header_social_links', true) && has_nav_menu('header-social-links')): ?>
	<div class="share-btn">
		<i class="pe-7s-share"></i>
		<?php
		wp_nav_menu(apply_filters('restarter_header_social_links_args', array(
			'depth' => 1,
			'menu_class' => 'dropdown',
			'theme_location' => 'header-social-links',
			'link_before'    => '<span class="sr-only">',
			'link_after'     => '</span>' . Restarter::get_icons_markup(array('icon' => 'chain'))
		)));
		?>
	</div><!-- .share-btn -->
	<?php endif; ?>
	<!-- Mobile Menu Toggle -->
	<div class="nav-toggle"><span></span></div>
</div><!-- .toolbar -->