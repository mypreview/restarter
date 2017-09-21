<?php
/**
 * Display footer social links.
 *
 * @package 		Hooked into "restarter_footer"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<div class="column">
	<?php
	if (has_nav_menu('footer-social-links')):
		wp_nav_menu(apply_filters('restarter_footer_social_links_args', array(
			'depth' => 1,
			'container' => 'div',
			'container_class' => 'social-bar',
			'theme_location' => 'footer-social-links',
			'link_before'    => '<span class="sr-only">',
			'link_after'     => '</span>' . Restarter::get_icons_markup(array('icon' => 'chain'))
		)));
	endif;
	?>
</div><!-- .column -->