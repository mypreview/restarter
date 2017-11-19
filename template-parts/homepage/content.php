<?php
/**
 * Displaying jumbotron / intro section on homepage template.
 *
 * @package 		Hooked into "restarter_homepage"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.2
 */
$container_cls = apply_filters('restarter_homepage_container_cls', 'fw-section padding-top-3x');
?>
<section id="restarter-homepage-<?php the_ID(); ?>" <?php post_class(esc_attr($container_cls)); ?>>
	<div class="container">
	<?php
	if (have_posts() && '' !== get_post()->post_content):
		?>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 homepage-content">
			<?php 
			while (have_posts()): the_post();
				the_content(); 
			endwhile;
			?>
			</div><!-- .col-lg-10.col-lg-offset-1 -->
		</div><!-- .row -->
	<?php endif; ?>
	</div><!-- .container -->
</section><!-- #restarter-homepage-<?php the_ID(); ?> -->