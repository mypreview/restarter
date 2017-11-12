<?php
/**
 * Display header toolbar.
 *
 * @package 		Hooked into "restarter_header"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.0
 */
?>
<!-- Toolbar -->
<div class="toolbar">
	<?php 
	if (apply_filters('restarter_header_search', true)): 
	$cta_btn_txt = esc_attr(get_option('restarter_plus_navigation_cta_btn_txt', ''));
	$search_btn_extra_cls = ($cta_btn_txt) ? ' with-cta' : '';
	?>
	<div class="search-btn<?php echo esc_attr($search_btn_extra_cls); ?>">
		<i class="pe-7s-search"></i>
		<?php get_search_form(); ?>
	</div><!-- .search-btn -->
	<?php 
	endif;
	if (apply_filters('restarter_header_social_links', true) && has_nav_menu('header-social-links')):
		if (apply_filters('restarter_header_search', true)):
	?>
	<span class="divider"></span>
	<?php endif; ?>
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
	<?php
	do_action('restarter_header_cta');
	endif; 
	?>
	<!-- Mobile Menu Toggle -->
	<div class="nav-toggle"><span></span></div>
</div><!-- .toolbar -->