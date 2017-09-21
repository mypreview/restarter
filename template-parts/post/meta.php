<?php
/**
 * Display the post meta.
 * 
 * @package 		Hooked into "restarter_after_post_content"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */
?>
<div class="single-post-toolbar space-top-2x space-bottom-2x">
	<div class="column">
		<?php Restarter::entry_date(); ?>
		<span class="post-author">
			<?php 
			esc_html_e('by ', 'restarter');
			the_author_posts_link(); 
			?>
		</span><!-- .post-author -->
		<?php
		$get_categories = get_the_category();
		if(! empty($get_categories)):
		?>
		<span class="delimiter">|</span>
		<span class="post-taxonomy">
			<?php
			esc_html_e('in ', 'restarter');
			the_category(', '); 
			?>
		</span><!-- .post-taxonomy -->
		<?php 
		endif;
		$get_tags = get_the_tags();
		if(! empty($get_tags)):
		?>
		<span class="delimiter">|</span>
		<span class="post-taxonomy">
			<?php
			the_tags('#', ' #', ''); 
			?>
		</span><!-- .post-taxonomy -->
		<?php endif; ?>
	</div><!-- .column -->
	<div class="column hidden">
	</div><!-- .column -->
</div><!-- .single-post-toolbar -->