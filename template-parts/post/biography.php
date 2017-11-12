<?php
/**
 * The template part for displaying an Author biography.
 *
 * @package 		Hooked into "restarter_after_post_content"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.0
 */
?>
<!-- Post Author -->
<div class="tile post-author-tile">
	<div class="tile-body">
		<h3><?php esc_html_e('About author', 'restarter'); ?></h3>
		<div class="inner">
			<div class="author-ava">
				<?php
				$author_bio_avatar_size = apply_filters('restarter_author_bio_avatar_size', 220);
				echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
				?>
			</div><!-- .author-ava -->
			<div class="author-info">
				<h3 class="author-name"><?php echo esc_html(get_the_author()); ?></h3>
				<a class="author-view-all author-link" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
					<?php printf(esc_attr__('View all posts by %s', 'restarter'), get_the_author()); ?>
				</a><!-- .author-link -->
				<p><?php the_author_meta('description'); ?></p>
			</div><!-- .author-info -->
		</div><!-- .inner -->
	</div><!-- .tile-body -->
</div><!-- .tile.post-author-tile -->