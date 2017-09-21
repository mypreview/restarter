<?php
/**
 * Restarter Credits.
 * Restarter theme comes as standard with a free download link mark. If you wish to remove this and update it with your text, you need to purchase Restarter Plus plugin.
 * 
 * @link 			https://www.mypreview.one
 * @package 		Hooked into "restarter_footer"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<div class="column">
	<?php
	$restarter_footer_logo = absint(get_theme_mod('restarter_footer_logo', ''));
	if ($restarter_footer_logo):
	?>
	<a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" target="_self">
		<?php echo wp_get_attachment_image($restarter_footer_logo, 'full'); ?>
	</a>
	<?php endif; ?>
	<span class="copy-text">
		<?php 
		echo apply_filters('restarter_copyright_text', $content = '&copy; ' . date_i18n(__('Y','restarter'))); 
		if (apply_filters('restarter_credit_link', true)):
            // You `HAVE` to keep this credit link. We really do appreciate it ;)
            printf(esc_attr__(' | Get %1$s for free.', 'restarter') , '<a href="' . esc_url(RestarterThemeURI) . '" rel="author" target="_blank">' . esc_attr(RestarterThemeName) . '</a>');
        endif;
		?>
	</span>
</div><!-- .column -->