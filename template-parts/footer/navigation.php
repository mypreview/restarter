<?php
/**
 * Display footer navigation.
 *
 * @package 		Hooked into "restarter_footer"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<div class="column">
	<?php
	if (has_nav_menu('footer')):
		wp_nav_menu(apply_filters('restarter_footer_navigation_args', array(
			'depth' => 1,
			'container' => 'nav',
			'container_class' => 'footer-nav',
			'theme_location' => 'footer'
		)));
	endif; 
	?>
</div><!-- .column -->