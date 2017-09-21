<?php
/**
 * Display site brand or logo.
 *
 * @package 		Hooked into "restarter_header"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
if (function_exists('the_custom_logo') && has_custom_logo()):
	the_custom_logo();
elseif (function_exists('jetpack_has_site_logo') && jetpack_has_site_logo()):
	jetpack_the_site_logo();
else: ?>
	<!-- Site Logo -->
	<a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo site-logo-text" target="_self" itemprop="headline" rel="home">
		<h1 class="space-bottom-none"><?php echo esc_attr(get_bloginfo('name')); ?></h1>
	</a><!-- .site-logo -->
<?php endif;