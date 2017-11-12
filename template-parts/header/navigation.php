<?php
/**
 * Display primary navigation.
 *
 * @package 		Hooked into "restarter_header"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<!-- Mobile Dropdown -->
<div class="mobile-dropdown">
	<!-- Mobile Tools -->
	<div class="mobile-tools">
		<?php 
		if (apply_filters('restarter_header_search', true)): 
			get_search_form(); 
		endif;
		if (apply_filters('restarter_header_social_links', true) && has_nav_menu('header-social-links')):
			wp_nav_menu(apply_filters('restarter_header_social_links_args', array(
				'depth' => 1,
				'container' => 'div',
				'container_class' => 'social-bar text-center',
				'theme_location' => 'header-social-links',
				'link_before'    => '<span class="sr-only">',
				'link_after'     => '</span>' . Restarter::get_icons_markup(array('icon' => 'chain'))
			)));
		endif;
		?>
	</div><!-- .mobile-tools -->
	<?php
	if (has_nav_menu('primary')):
		wp_nav_menu(apply_filters('restarter_primary_navigation_args', array(
			'depth' => 2,
			'container' => 'nav',
			'container_id' => 'restarter-main-navigation',
			'container_class' => 'main-navigation',
			'menu_class' => 'menu',
			'theme_location' => 'primary',
			'fallback_cb' => 'Restarter_Bootstrap_Navwalker::fallback',
			'walker' => new Restarter_Bootstrap_Navwalker()
		)));
	endif; 
	?>
</div><!-- .mobile-dropdown -->