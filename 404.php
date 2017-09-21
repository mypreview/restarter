<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.0.0
 */
get_header();
?>
<div class="page-404 <?php echo (apply_filters('restarter_404_light_skin', false)) ? ' light-skin': ''; ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
				<h1><?php esc_html_e('404', 'restarter'); ?></h1>
				<h2><?php esc_html_e('Oops, the page you\'re looking for does not exist.', 'restarter'); ?></h2>
				<p><?php esc_html_e('You may want to head back to the homepage. If you think something is broken, please do not hesitate to report a problem.', 'restarter'); ?></p>
				<a href="<?php echo esc_url(home_url()); ?>" class="btn btn-ghost btn-default btn-icon-left" target="_self">
					<i class="icon-arrow-left"></i>
					<?php esc_html_e('Back to Homepage', 'restarter'); ?>
				</a>
			</div><!-- .col-lg-6.col-lg-offset-3.col-md-8.col-md-offset-2 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .page-404 -->
<?php 
get_footer();