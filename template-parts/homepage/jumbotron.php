<?php
/**
 * Displaying jumbotron / intro section on homepage template.
 *
 * @package 		Hooked into "restarter_before_homepage"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.5
 */

$heading = esc_html(get_theme_mod('restarter_jumbotron_heading', ''));
$description = wp_kses_post(get_theme_mod('restarter_jumbotron_description', ''));
$btn_txt = esc_html(get_theme_mod('restarter_jumbotron_btn_txt', ''));
$btn_url = esc_url(get_theme_mod('restarter_jumbotron_btn_url', '#'));
$target = (bool) get_theme_mod('restarter_jumbotron_btn_url_target', false);
(true === $target) ? $target = '_blank' : $target = '_self';
$btn_icon = esc_attr(get_theme_mod('restarter_jumbotron_btn_icon', 'icon-arrow-right'));
$btn_icon_float = esc_attr(get_theme_mod('restarter_jumbotron_btn_icon_float', 'right'));
$parallax = (bool) get_theme_mod('restarter_jumbotron_background_parallax', true);
$scroll_speed = absint(get_theme_mod('restarter_jumbotron_background_parallax_scroll_speed', 5));
($scroll_speed) ? $scroll_speed = (int) $scroll_speed / 10 : $scroll_speed = 0.5;
$frame_image = absint(get_theme_mod('restarter_jumbotron_frame_image', ''));
$background_image = absint(get_theme_mod('restarter_jumbotron_background_image', ''));
($background_image) ? $background_image = wp_get_attachment_image_url($background_image, 'full', false) : $background_image = '';
// If the parallax effect is disbaled
if (false === $parallax):
	$scroll_speed = 1;
endif;
$loop = (bool) get_theme_mod('restarter_jumbotron_slider_loop', false);
(true === $loop) ? $loop = 'true' : $loop = 'false';
$autoplay = (bool) get_theme_mod('restarter_jumbotron_slider_autoplay', true);
(true === $autoplay) ? $autoplay = 'true' : $autoplay = 'false';
$interval = absint(get_theme_mod('restarter_jumbotron_slider_interval', 4000));
$slider_images = esc_attr(get_theme_mod('restarter_jumbotron_slider_images', ''));
(!empty($slider_images)) ? $slider_images = explode(',', $slider_images) : $slider_images = '';
?>
<section class="restarter-jumbotron intro-section data-background" data-stellar-background-ratio="<?php echo floatval($scroll_speed); ?>" data-background="<?php echo esc_url($background_image); ?>">
	<span class="overlay"></span>
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-lg-offset-1 col-sm-6 padding-bottom-3x mobile-center">
				<div class="padding-top-3x hidden-xs"></div>
				<?php if (!empty($heading)): ?>
				<h2 class="text-light heading"><?php echo esc_html($heading); ?></h2>
				<?php endif; ?>
				<?php if (!empty($description)): ?>
				<p class="text-light opacity-50 description"><?php echo wp_kses_post(nl2br($description)); ?></p>
				<?php 
				endif;
				do_action('restarter_jumbotron_social_links');
				if (!empty($btn_txt)): 
				?>
				<div class="mobile-center">
					<a href="<?php echo esc_url($btn_url); ?>" class="btn btn-ghost btn-light btn-icon-<?php echo esc_attr($btn_icon_float); ?>" target="<?php echo esc_attr($target); ?>">
						<?php if ('left' === $btn_icon_float): ?>
						<i class="<?php echo esc_attr($btn_icon); ?>"></i>
						<?php echo esc_html($btn_txt); ?>
						<?php else: ?>
						<?php echo esc_html($btn_txt); ?>
						<i class="<?php echo esc_attr($btn_icon); ?>"></i>
						<?php endif; ?>
					</a><!-- .btn -->
				</div><!-- .mobile-center -->
				<?php endif; ?>
			</div><!-- .col-lg-5.col-lg-offset-1.col-sm-6 -->
			<div class="col-sm-6">
				<div class="phone-carousel light-controls" data-loop="<?php echo esc_attr($loop); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-interval="<?php echo intval($interval); ?>">
					<div class="phone">
						<?php
						if (isset($frame_image) && !empty($frame_image)):
							echo wp_get_attachment_image(intval($frame_image), array(400, 762));
						else:
						?>
						<img src="<?php echo esc_url(apply_filters('restarter_jumbotron_default_device_frame_image_url', get_template_directory_uri() . '/assets/img/restarter-jumbotron-phone.png')); ?>" width="400" height="762" alt="<?php echo esc_attr('Phone', 'restarter'); ?>" />
						<?php endif; ?>
						<div class="inner">
							<?php
							if (!empty($slider_images) && is_array($slider_images)):
								foreach((array) $slider_images as $slider_image):
									echo wp_get_attachment_image(intval($slider_image), array(306,543));
								endforeach;
							endif;
							?>
		                </div><!-- .inner -->
					</div><!-- .phone -->
				</div><!-- .phone-carousel -->
			</div><!-- .col-sm-6 -->
		</div><!-- .row -->
	</div><!-- .container -->
</section><!-- .restarter-jumbotron -->