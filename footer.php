<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the .page-wrapper div and all content after
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.0.0
 */
		/**
		 * Functions hooked into "restarter_before_footer" action
		 *
		 * @hooked restarter_footer_scroll_to_top   		- 10
		 * @since 1.0.0
		 */
		do_action('restarter_before_footer');
		?>
		<footer class="footer space-top-3x<?php echo esc_attr(apply_filters('restarter_footer_extra_cls', '')); ?>" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<div class="container">
				<?php 
				/**
				 * Functions hooked into "restarter_footer" action
				 *
				 * @hooked restarter_footer_wrapper_start    - 5
				 * @hooked restarter_footer_credits   		 - 10
				 * @hooked restarter_footer_navigation       - 20
				 * @hooked restarter_footer_social_links     - 30
				 * @hooked restarter_footer_wrapper_end      - 35
				 * @since 1.0.0
				 */
				do_action('restarter_footer'); 
				?>
			</div><!-- .container -->
		</footer><!-- .footer -->
		</div><!-- .page-wrapper -->
		<?php 
		do_action('restarter_after_footer');
		wp_footer(); 
		?>
	</body>
</html>