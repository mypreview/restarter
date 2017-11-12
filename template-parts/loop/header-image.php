<?php
/**
 * Displaying header image.
 *
 * @package 		Hooked into "restarter_before_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.0
 */

$header_image = '';
if (has_header_image() && !is_singular()):
	$header_image = get_header_image();
elseif (is_singular() && has_post_thumbnail()):
	global $post;
	$header_image_id = absint(get_post_thumbnail_id($post->ID));
	$header_image = wp_get_attachment_image_url($header_image_id, 'full');
endif;
$is_front_page_configured = Restarter::is_front_page_configured();
$get_front_page_title = Restarter::get_front_page_title();
$get_front_page_url = Restarter::get_front_page_url();
$is_posts_page_configured = Restarter::is_posts_page_configured();
$get_posts_page_title = Restarter::get_posts_page_title();
$get_posts_page_url = Restarter::get_posts_page_url();
?>
<!-- Page Title -->
<div class="page-title data-background<?php echo (apply_filters('restarter_light_header_image', true)) ? ' pt-dark' : ''; ?>" data-background="<?php echo (! empty($header_image)) ? esc_url($header_image) : ''; ?>" data-stellar-background-ratio="0.65">
	<span class="overlay ie-gradient<?php echo (apply_filters('restarter_darker_opacity', true)) ? ' darker' : ''; ?>"></span>
	<div class="container">
		<div class="inner">
			<div class="title<?php echo (! apply_filters('restarter_go_back', true) || ! is_singular() && ! $is_front_page_configured) ? ' padding-left-none' : ''; ?>">
				<?php 
				if ($is_front_page_configured && $is_posts_page_configured && apply_filters('restarter_go_back', true)):
				?>
				<span class="back-btn icon-arrow-left" onclick="restarterGoBack()"></span>
				<?php elseif(apply_filters('restarter_go_back', true) && is_singular()): ?>
				<span class="back-btn icon-arrow-left" onclick="restarterGoBack()"></span>
				<?php 
				endif;
				if (!empty($is_posts_page_configured) && !is_singular() && is_home()):
					echo '<h1 class="space-top-none">' . esc_html($get_posts_page_title) . '</h1>';
				elseif (!is_singular() && is_archive()):
					the_archive_title('<h1>', '</h1>');
					the_archive_description('<div class="text-light text-italic small opacity-50 taxonomy-description">', '</div>');
				elseif (is_singular() && !is_archive()):
					the_title('<h1 class="space-top-none">', '</h1>');
				endif;
				?>
			</div><!-- .title -->
			<div class="breadcrumbs">
			<?php Restarter::the_breadcrumb(); ?>
			</div><!-- .breadcrumbs -->
		</div><!-- .inner -->
	</div><!-- .container -->
</div><!-- .page-title -->