<?php
/**
 * The sidebar containing the main widget area.
 *
 * @see 		https://codex.wordpress.org/Function_Reference/dynamic_sidebar
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 		1.1.0
 */

if (!is_active_sidebar('sidebar')):
	return;
endif;
?>
<!-- Sidebar -->
<div class="<?php echo esc_attr(apply_filters('restarter_sidebar_wrapper_cls', 'col-lg-3 col-md-4 col-sm-5')); ?>" role="complementary" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
	<div class="padding-top visible-xs"></div>
	<aside class="sidebar space-bottom">
		<?php dynamic_sidebar('sidebar'); ?>
	</aside><!-- .sidebar -->
</div><!-- .col-lg-3 col-md-4 col-sm-5 -->