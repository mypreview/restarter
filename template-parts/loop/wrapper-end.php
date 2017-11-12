<?php
/**
 * Display loop HTML wrapper end tag(s).
 *
 * @package 		Hooked into "restarter_after_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.0
 */

if (is_active_sidebar('sidebar') && ! Restarter::is_fluid_template()):
?>
		</div><!-- .<?php echo esc_attr(apply_filters('restarter_content_wrapper_cls', 'col-lg-9 col-md-8 col-sm-7')); ?> -->
		<?php get_sidebar(); ?>
	</div><!-- .row -->
</div><!-- .container -->
<?php else: ?>
</div><!-- .content-no-sidebar -->
<?php endif;