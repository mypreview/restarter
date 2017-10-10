<?php
/**
 * Display loop HTML wrapper end tag(s).
 *
 * @package 		Hooked into "restarter_after_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.1
 */

if (is_active_sidebar('sidebar') && ! Restarter::is_fluid_template()):
?>
		</div><!-- .col-lg-3.col-md-4.col-sm-5 -->
		<?php get_sidebar(); ?>
	</div><!-- .row -->
</div><!-- .container -->
<?php else: ?>
</div><!-- .content-no-sidebar -->
<?php endif;