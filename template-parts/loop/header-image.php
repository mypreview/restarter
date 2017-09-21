<?php
/**
 * Displaying header image.
 *
 * @package 		Hooked into "restarter_before_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */

$header_image = '';
if (has_header_image() && ! is_singular()):
	$header_image = get_header_image();
elseif (is_singular() && has_post_thumbnail()):
	global $post;
	$header_image_id = absint(get_post_thumbnail_id($post->ID));
	$header_image = wp_get_attachment_image_url($header_image_id, 'full');
endif;
?>
<!-- Page Title -->
<div class="page-title data-background<?php echo (apply_filters('restarter_light_header_image', true)) ? ' pt-dark' : ''; ?>" data-background="<?php echo (! empty($header_image)) ? esc_url($header_image) : ''; ?>" data-stellar-background-ratio="0.65">
	<span class="overlay ie-gradient<?php echo (apply_filters('restarter_darker_opacity', true)) ? ' darker' : ''; ?>"></span>
	<div class="container">
		<div class="inner">
			<div class="title<?php echo (! apply_filters('restarter_go_back', true) || ! is_singular()) ? ' padding-left-none' : ''; ?>">
				<?php if (apply_filters('restarter_go_back', true) && is_singular()): ?>
				<span class="back-btn icon-arrow-left" onclick="restarterGoBack()"></span>
				<?php endif; ?>
				<?php 
				$get_posts_page = get_option('page_for_posts', true);
				if (! empty($get_posts_page) && ! is_singular()):
					echo '<h1>' . esc_html($get_posts_page) . '</h1>'; 
				elseif (is_singular() && ! is_archive()):
					the_title('<h1>', '</h1>');
				endif;
				?>
			</div><!-- .title -->
			<div class="breadcrumbs">
				<?php Restarter::the_breadcrumb(); ?>
			</div><!-- .breadcrumbs -->
		</div><!-- .inner -->
	</div><!-- .container -->
</div><!-- .page-title -->